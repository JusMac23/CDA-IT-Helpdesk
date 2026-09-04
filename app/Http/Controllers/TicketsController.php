<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CreateTicketPrivateController;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Tickets;
use App\Models\Divisions;
use App\Models\TechnicalServices;
use App\Models\ITPersonnel;
use App\Models\ReassignedTicket;
use App\Models\Notification;
use App\Models\User;

use App\Traits\RoundRobinAssignable;

use App\Mail\TicketSubmitted;
use App\Mail\TicketUpdated;
use App\Mail\TicketResolved;
use App\Mail\TicketReassigned;

class TicketsController extends Controller
{   
    // Helper to safely format IT personnel's full name
    use RoundRobinAssignable; 

    public function index(Request $request)
    {
        // 1. Get logged-in user details safely
        $user = Auth::user();
        $loggedInEmail = trim($user->email ?? '');

        // 2. Fetch the role name from the 'roles' table
        $roleName = DB::table('roles')->where('id', $user->role ?? null)->value('name') ?? '';
        $userRole = strtoupper(trim($roleName));

        // 3. Initialize base query
        $query = Tickets::query();

        // 4. Apply Role-Based Access Control
        if ($userRole === 'ICTS' || $userRole === 'ICTD') {
            $query->where('it_email', $loggedInEmail);
        }

        // 5. Calculate total and overdue counts based strictly on role scope
        $ticketsCount = (clone $query)->count();

        $overdueCount = (clone $query)
            ->where('status', '!=', 'Resolved')
            ->where('date_created', '<', Carbon::now()->subDays(3))
            ->count();

        // 6. Apply request filters
        if ($request->input('filter') === 'overdue') {
            $query->where('status', '!=', 'Resolved')
                ->where('date_created', '<', Carbon::now()->subDays(2));
        }

        if ($request->filled('it_area')) {
            $query->where('it_area', trim($request->input('it_area')));
        }

        if ($request->filled('status')) {
            $query->where('status', trim($request->input('status')));
        }

        if ($request->filled('priority')) {
            $query->where('priority', trim($request->input('priority')));
        }

        if ($request->filled('start_date')) {
            $query->whereDate('date_created', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date_created', '<=', $request->input('end_date'));
        }

        // 7. Apply search filter
        if ($request->filled('search_query')) {
            $search = trim($request->input('search_query'));
            $query->where(function ($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                  ->orWhere('ticket_number', 'like', "%{$search}%")
                  ->orWhere('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('division', 'like', "%{$search}%")
                  ->orWhere('it_area', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('device', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%")
                  ->orWhere('request', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('it_personnel', 'like', "%{$search}%")
                  ->orWhere('action_taken', 'like', "%{$search}%")
                  ->orWhere('priority', 'like', "%{$search}%");
            });
        }

        // 8. CSV export handler
        if ($request->input('action') === 'generate') {
            return $this->generateCSVReport($query->get());
        }

        // 9. Paginate records
        $tickets = $query->orderBy('ticket_id', 'desc')->paginate(10);
        $tickets->appends($request->all());

        $ticket = null;

        // 10. Fetch Dropdowns & Round-Robin Data required by the embedded Add Ticket Modal
        $sections_divisions = Divisions::pluck('sections_divisions')->filter()->toArray();
        $technical_services = TechnicalServices::pluck('technical_services')->filter()->toArray();

        $it_area = ITPersonnel::whereNotNull('it_area')
            ->where('it_area', '!=', '')
            ->distinct()
            ->pluck('it_area')
            ->values();

        $nextAssignment = [];

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

            $assignedDefault = $this->getNextAssignedPersonnel($area, null);
            if ($assignedDefault) {
                $nextAssignment["{$area}_default"] = [
                    'name'  => $this->formatFullName($assignedDefault),
                    'email' => $assignedDefault->it_email,
                ];
            }
        }

        // Fetch Reassignable IT Personnel and group purely by IT Area
        $reassignable_personnel = ITPersonnel::all(['firstname', 'middle_initial', 'lastname', 'it_email', 'it_area']);
        
        $reassignable_it_area = $reassignable_personnel->pluck('it_area')->unique()->values();

        $reassignable_it_mapping = $reassignable_personnel->groupBy('it_area')
            ->map(fn($group) => 
                $group->values()->map(fn($p) => [
                    'name'  => trim("{$p->firstname} {$p->middle_initial} {$p->lastname}"),
                    'email' => $p->it_email,
                ])
            )->toArray();

        // 11. Render view with ticket list AND modal data
        return view('tickets.index', compact(
            'request',
            'ticketsCount',
            'overdueCount',
            'tickets',
            'ticket',
            'sections_divisions',
            'technical_services',
            'it_area',
            'reassignable_it_area',
            'reassignable_it_mapping',
            'nextAssignment'
        ));
    }

    /**
     * Generate downloadable CSV report.
     */
    public function generateCSVReport($tickets)
    {
        $filename = "tickets_report_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Ticket Number', 'First Name', 'Last Name', 'Division', 'IT Area', 'Email',
            'Device', 'Service', 'Request', 'Status', 'Date Created', 'Date Resolved', 'IT Personnel'
        ];

        $callback = function () use ($tickets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tickets as $ticket) {
                fputcsv($file, [
                    $ticket->ticket_number,
                    $ticket->firstname,
                    $ticket->lastname,
                    $ticket->division,
                    $ticket->it_area,
                    $ticket->email,
                    $ticket->device,
                    $ticket->service,
                    $ticket->request,
                    $ticket->status,
                    $ticket->date_created,
                    $ticket->date_resolved,
                    $ticket->it_personnel
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Reassign ticket to another IT personnel with validation and notifications.
     */
    public function assign(Request $request)
    {
        // Validate the request
        $request->validate([
            'ticket_id'         => 'required|integer|exists:tickets,ticket_id',
            'assigned_to'        => 'required|string',
            'assigned_it_email' => 'required|email',
            'notes'             => 'nullable|string'
        ]);

        $ticket = Tickets::findOrFail($request->ticket_id);

        // Prevent assigning if ticket is resolved
        if ($ticket->status === 'Resolved') {
            return redirect()->back()->with('error', 'Cannot assign a resolved ticket.');
        }

        // Prevent assigning same personnel
        if (
            $ticket->it_personnel &&
            $ticket->it_personnel === $request->assigned_to &&
            $ticket->it_email === $request->assigned_it_email
        ) {
            return redirect()->back()->with('error', 'You cannot reassign the same personnel. Please select another personnel.');
        }

        // Save previous assigned personnel
        $previous_assigned = $ticket->it_personnel ?? 'N/A';

        // Update ticket with new assignee
        $ticket->update([
            'status'            => 'Pending/Re-Assigned',
            'it_personnel'      => $request->assigned_to,
            'it_email'          => $request->assigned_it_email,
            'assigned_to'       => $request->assigned_to,
            'assigned_it_email' => $request->assigned_it_email,
            'notes'             => $request->notes,
        ]);

        // Log reassignment
        ReassignedTicket::create([
            'ticket_number'     => $ticket->ticket_number,
            'requested_by'      => $ticket->firstname . ' ' . $ticket->lastname,
            'request'           => $ticket->request,
            'assigned_by'       => Auth::user()->name,
            'previous_assigned' => $previous_assigned,
            'assigned_to'       => $request->assigned_to,
            'notes'             => $request->notes,
            'assigned_at'       => now(),
        ]);

        if ($ticket->it_email) {
            Mail::to($ticket->it_email)->send(new TicketReassigned($ticket));
        }

        // Notify the reassigned personnel
        $user = User::where('email', $request->assigned_it_email)->first();
        if ($user) {
            Notification::create([
                'user_id'   => $user->id,
                'ticket_id' => $ticket->ticket_id,
                'type'      => 'ticket_reassigned',
                'message'   => "Ticket #{$ticket->ticket_number} has been reassigned to you",
            ]);
        }

        // Notify the requestee (ticket owner)
        $requesterUser = User::where('email', $ticket->email)->first();
        if ($requesterUser) {
            Notification::create([
                'user_id'   => $requesterUser->id,
                'ticket_id' => $ticket->ticket_id,
                'type'      => 'ticket_reassigned_requester',
                'message'   => "Your ticket #{$ticket->ticket_number} has been reassigned to {$request->assigned_to}",
            ]);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket successfully re-assigned.');
    }

    /**
     * Show the edit form for a specific ticket.
     */
    public function edit($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);

        $it_personnel = ITPersonnel::all();
        $it_area = $it_personnel->pluck('it_area')->unique()->values();
        $sections_divisions = Divisions::pluck('sections_divisions')->toArray();
        $technical_services = TechnicalServices::pluck('technical_services')->toArray();

        return view('tickets.index', compact('ticket', 'it_personnel', 'it_area', 'sections_divisions', 'technical_services'));
    }

    /**
     * Update ticket details with validation, file handling, and notifications.
     */
    public function update(Request $request, $ticket_id)
    {
        $validatedData = $request->validate([
            'priority' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'date_resolved' => 'required|date',
            'action_taken' => 'required|string',
            'photo' => 'nullable|image|max:10240',
        ]);

        $ticket = Tickets::findOrFail($ticket_id);

        $validatedData['date_resolved'] = \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('ticket_photos', 'public');
        }

        $ticket->update($validatedData);

        if ($ticket->email && $ticket->it_email) {
            // Send email notification to both requester and IT personnel
            Mail::to($ticket->email)->send(new TicketUpdated($ticket));
            Mail::to($ticket->it_email)->send(new TicketResolved($ticket));
        }

        if ($ticket->status === 'Resolved') {
            $requesterUser = User::where('email', $ticket->email)->first();
            if ($requesterUser) {
                Notification::create([
                    'user_id' => $requesterUser->id,
                    'ticket_id' => $ticket->ticket_id,
                    'type' => 'ticket_resolved',
                    'message' => "Your ticket #{$ticket->ticket_number} has been resolved",
                ]);
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Delete a ticket.
     */
    public function destroy($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);
        
        // Save ticket number before deleting
        $ticketNumber = $ticket->ticket_number;

        // Delete photo if it exists
        if ($ticket->photo && Storage::disk('public')->exists($ticket->photo)) {
            Storage::disk('public')->delete($ticket->photo);
        }

        // Delete the ticket record
        $ticket->delete();

        // Delete reassigned records
        ReassignedTicket::where('ticket_number', $ticketNumber)->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

}