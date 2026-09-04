<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Tickets;
use App\Models\Divisions;
use App\Models\TechnicalServices;
use App\Models\ITPersonnel;
use App\Models\Notification;
use App\Models\User;
use App\Mail\TicketSubmitted;

class CreateTicketPublicController extends Controller
{
    // Safely formats the IT personnel's full name, handling NULL middle initials.
    private function formatFullName($personnel): string
    {
        if (!$personnel) {
            return '';
        }

        $parts = array_filter([
            $personnel->firstname ?? null,
            $personnel->middle_initial ?? null,
            $personnel->lastname ?? null
        ], fn($val) => !is_null($val) && trim($val) !== '');

        return implode(' ', $parts);
    }

    // Calculates the next IT personnel in line using Round-Robin logic for a given area & technical service.
    // Automatically loops back to index 0 when the end of the pool is reached.
    private function getNextAssignedPersonnel(string $area, ?string $service = null)
    {
        if (empty($area)) {
            return null;
        }

        // 1. Fetch all personnel in this area ordered by ID sequence
        $allAreaPersonnel = ITPersonnel::where('it_area', $area)
            ->orderBy('id', 'asc')
            ->get();

        if ($allAreaPersonnel->isEmpty()) {
            return null;
        }

        $cleanService = $service ? trim($service) : null;
        $usedServiceFilter = false;

        // 2. Filter personnel matching the technical service category
        $pool = collect();
        if ($cleanService) {
            $pool = $allAreaPersonnel->filter(function ($p) use ($cleanService) {
                $p_services = array_map('trim', explode(',', $p->tech_services_category ?? ''));
                return in_array($cleanService, $p_services, true);
            })->values();

            if ($pool->isNotEmpty()) {
                $usedServiceFilter = true;
            }
        }

        // Fallback to all area personnel if no exact service match exists
        if ($pool->isEmpty()) {
            $pool = $allAreaPersonnel->values();
        }

        $totalCount = $pool->count();
        if ($totalCount === 0) {
            return null;
        }

        // 3. Find last submitted ticket for this area and service
        $ticketPk = (new Tickets)->getKeyName();
        $lastTicketQuery = Tickets::where('it_area', $area)->orderBy($ticketPk, 'desc');

        if ($cleanService && $usedServiceFilter) {
            $lastTicketQuery->where('service', $cleanService);
        }

        $lastTicket = $lastTicketQuery->first();

        // 4. Calculate next index (Modulo ensures loop back to index 0 when last person is reached)
        $nextIndex = 0;

        if ($lastTicket && $lastTicket->it_email) {
            $lastEmail = trim($lastTicket->it_email);
            $lastIndex = $pool->search(function ($p) use ($lastEmail) {
                return strtolower(trim($p->it_email)) === strtolower($lastEmail);
            });

            if ($lastIndex !== false) {
                // Example: Pool size 3. Last assigned index = 2 (3rd person).
                // (2 + 1) % 3 = 0 -> Loops back to the 1st person!
                $nextIndex = ($lastIndex + 1) % $totalCount;
            }
        }

        return $pool->get($nextIndex);
    }

    // Show the ticket form
    public function showForm()
    {
        $sections_divisions = Divisions::pluck('sections_divisions')->filter()->toArray();
        $technical_services = TechnicalServices::pluck('technical_services')->filter()->toArray();

        $it_area = ITPersonnel::whereNotNull('it_area')
            ->where('it_area', '!=', '')
            ->distinct()
            ->pluck('it_area')
            ->values();

        $nextAssignment = [];

        // Pre-calculate round-robin assignment mapping for frontend JS lookup
        foreach ($it_area as $area) {
            foreach ($technical_services as $service) {
                $assigned = $this->getNextAssignedPersonnel($area, $service);
                if ($assigned) {
                    $nextAssignment["{$area}_{$service}"] = [
                        'name'  => $this->formatFullName($assigned),
                        'email' => $assigned->it_email,
                    ];
                }
            }

            // Default fallback mapping if service is not selected yet
            $assignedDefault = $this->getNextAssignedPersonnel($area, null);
            if ($assignedDefault) {
                $nextAssignment["{$area}_default"] = [
                    'name'  => $this->formatFullName($assignedDefault),
                    'email' => $assignedDefault->it_email,
                ];
            }
        }

        return view('tickets.create_ticket', [
            'sections_divisions' => $sections_divisions,
            'technical_services' => $technical_services,
            'it_area'            => $it_area,
            'nextAssignment'     => $nextAssignment,
        ]);
    }

    // Store the ticket
    public function store(Request $request)
    {
        // Server-side Round-Robin Auto-Assignment
        if ($request->filled('it_area')) {
            $area = $request->input('it_area');
            $service = $request->input('service');

            $assigned = $this->getNextAssignedPersonnel($area, $service);

            if ($assigned) {
                $request->merge([
                    'it_personnel' => $this->formatFullName($assigned),
                    'it_email'     => $assigned->it_email,
                ]);
            }
        }

        // Validate form inputs
        $validatedData = $request->validate([
            'firstname'    => 'required|string|max:255',
            'lastname'     => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'date_created' => 'required|date',
            'division'     => 'required|string|max:255',
            'device'       => 'required|string|max:255',
            'service'      => 'required|string|max:255',
            'request'      => 'required|string',
            'it_area'      => 'required|string|max:255',
            'it_personnel' => 'required|string',
            'it_email'     => 'required|string|email',
            'status'       => 'required|string|max:255',
            'photo'        => 'nullable|image|max:10240',
            'priority'     => 'required|string|max:255',
        ]);

        $validatedData['date_created']  = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        $validatedData['date_resolved'] = null;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('ticket_photos', 'public');
        }

        // Create ticket
        $ticket = Tickets::create($validatedData);

        // Generate unique ticket number
        do {
            $ticket_number = strtoupper(Str::random(6));
        } while (Tickets::where('ticket_number', $ticket_number)->exists());

        $ticket->ticket_number = $ticket_number;
        $ticket->save();

        // Send email safely and create in-app notification
        if ($ticket->it_email && filter_var($ticket->it_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($ticket->it_email)->send(new TicketSubmitted($ticket));
            } catch (\Exception $e) {
                Log::error('Failed to send ticket email notification: ' . $e->getMessage());
            }

            $this->createNotification(
                $ticket,
                $ticket->it_email,
                'ticket_created',
                "New ticket #{$ticket->ticket_number} assigned to you"
            );
        }

        return redirect()->back()->with('success', 'Ticket submitted successfully. Email notification sent to assigned IT personnel.');
    }

    // Create in-app notification
    private function createNotification($ticket, $email, $type, $message)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $ticketId = $ticket->getKey();

            Notification::create([
                'user_id'   => $user->id,
                'ticket_id' => $ticketId,
                'type'      => $type,
                'message'   => $message,
            ]);
        }
    }
}