<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Tickets;
use App\Models\Notification;
use App\Models\User;
use App\Mail\TicketSubmitted;
use App\Traits\RoundRobinAssignable;

class CreateTicketPrivateController extends Controller
{
    use RoundRobinAssignable; 

    /**
     * Store and process private ticket creation submitted from the modal.
     */
    public function store(Request $request)
    {
        // 1. Enforce backend round-robin assignment logic
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

        // 2. Validate input fields
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

        // 3. Format timestamps
        $validatedData['date_created']  = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        $validatedData['date_resolved'] = null;

        // 4. Handle file attachment
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('ticket_photos', 'public');
        }

        // 5. Create ticket record
        $ticket = Tickets::create($validatedData);

        // 6. Generate unique 6-character random ticket number
        do {
            $ticket_number = strtoupper(Str::random(6));
        } while (Tickets::where('ticket_number', $ticket_number)->exists());

        $ticket->ticket_number = $ticket_number;
        $ticket->save();

        // 7. Dispatch Email notification and In-App Alert
        if ($ticket->it_email && filter_var($ticket->it_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($ticket->it_email)->send(new TicketSubmitted($ticket));
            } catch (\Exception $e) {
                Log::error('Failed sending private ticket notification: ' . $e->getMessage());
            }

            $this->createNotification(
                $ticket,
                $ticket->it_email,
                'ticket_created',
                "New ticket #{$ticket->ticket_number} assigned to you"
            );
        }

        // 8. Handle JSON/AJAX or standard redirects
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Ticket created successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Ticket submitted successfully.');
    }

    /**
     * Create in-app system notification.
     */
    private function createNotification($ticket, $email, $type, $message)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            Notification::create([
                'user_id'   => $user->id,
                'ticket_id' => $ticket->getKey(),
                'type'      => $type,
                'message'   => $message,
            ]);
        }
    }
}