<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Mail\TicketReassigned;
use App\Mail\TicketResolved;
use App\Mail\TicketUpdated;
use App\Mail\TicketSubmitted;
use App\Models\Divisions;
use App\Models\ITPersonnel;
use App\Models\ReassignedTicket;
use App\Models\TechnicalServices;
use App\Models\Tickets;
use App\Models\Notification;
use App\Models\User;

class MyRequestedTicketsController extends Controller
{
   
    public function index(Request $request)
    {
        $loggedInEmail = Auth::user()->email;

        $tickets = Tickets::where('email', $loggedInEmail)
                    ->orderBy('ticket_id', 'desc')
                    ->paginate(10);

        // Fetch additional data for dropdowns
        $it_personnel = ITPersonnel::all();
        $it_area = $it_personnel->pluck('it_area')->unique()->values();
        $sections_divisions = Divisions::pluck('sections_divisions')->toArray();
        $technical_services = TechnicalServices::pluck('technical_services')->toArray();

        // Mapping for IT personnel autocomplete
        $it_mapping = $it_personnel->groupBy('it_area')
            ->map(fn($group) =>
                $group->map(fn($p) => [
                    'name' => trim("{$p->firstname} {$p->middle_initial} {$p->lastname}"),
                    'email' => $p->it_email
                ])
            );

        $ticket = null;

        return view('tickets.myrequested_tickets', compact(
            'tickets',
            'it_area',
            'it_personnel',
            'sections_divisions',
            'technical_services',
            'it_mapping',
            'ticket'
        ));
    }

    // Store the ticket
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'firstname'      => 'required|string|max:255',
            'lastname'       => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'date_created'   => 'required|date',
            'division'       => 'required|string|max:255',
            'device'         => 'required|string|max:255',
            'service'        => 'required|string|max:255',
            'request'        => 'required|string',
            'it_area'        => 'required|string|max:255',
            'it_personnel'   => 'required|string|max:255',
            'it_email'       => 'required|email|max:255',
            'status'         => 'required|string|max:255',
            'photo'          => 'nullable|image|max:10240',
        ]);

        $validatedData['date_created'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        $validatedData['date_resolved'] = null;

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('ticket_photos', 'public');
        }

        // Save ticket
        $ticket = Tickets::create($validatedData);

        // Generate unique ticket number
        do {
            $ticket_number = strtoupper(Str::random(6));
        } while (Tickets::where('ticket_number', $ticket_number)->exists());

        $ticket->ticket_number = $ticket_number;
        $ticket->save();

        // Send email notification
        if ($ticket->it_email) {
            Mail::to($ticket->it_email)->send(new TicketSubmitted($ticket));
        }

        $this->createNotification(
            $ticket, 
            'ticket_created', 
            "New ticket #{$ticket->ticket_number} assigned to you"
        );

        return redirect()->back()->with('success', 'Ticket submitted and Email Sent to Requesting Personnel.');
    }

    private function createNotification($ticket, $type, $message)
    {
        // Find IT personnel user by email
        $user = User::where('email', $ticket->it_email)->first();
        
        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->ticket_id,
                'type' => $type,
                'message' => $message,
            ]);
        }
    }

    public function assign(Request $request)
    {
        $it_personnel = ITPersonnel::all(['firstname', 'middle_initial', 'lastname', 'it_email', 'it_area']);
        $it_area = $it_personnel->pluck('it_area')->unique()->values();

        $it_mapping = $it_personnel->groupBy('it_area')
            ->map(fn($group) =>
                $group->map(fn($p) => [
                    'name' => trim("{$p->firstname} {$p->middle_initial} {$p->lastname}"),
                    'email' => $p->it_email
                ])
            );

        $request->validate([
            'ticket_id' => 'required|integer|exists:tickets,ticket_id',
            'assigned_to' => 'required|string',
            'assigned_it_email' => 'required|email',
            'notes' => 'nullable|string'
        ]);

        $ticket = Tickets::findOrFail($request->ticket_id);

        $ticket->status = 'Pending/Re-Assigned';
        $ticket->assigned_to = $request->assigned_to;
        $ticket->assigned_it_email = $request->assigned_it_email;
        $ticket->notes = $request->notes;
        $ticket->save();

        ReassignedTicket::create([
            'ticket_number'  => $ticket->ticket_number,
            'requested_by'   => $ticket->firstname . ' ' . $ticket->lastname,
            'request'        => $ticket->request,
            'assigned_by'    => Auth::user()->name,
            'assigned_to'    => $request->assigned_to,
            'notes'          => $request->notes,
            'assigned_at'    => now()
        ]);

        if ($ticket->it_email) {
            Mail::to($ticket->it_email)->send(new TicketReassigned($ticket));
        }

        $user = User::where('email', $request->assigned_it_email)->first();
        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->ticket_id,
                'type' => 'ticket_reassigned',
                'message' => "Ticket #{$ticket->ticket_number} has been reassigned to you",
            ]);
        }

        return redirect()->route('myrequested_tickets.index')->with('success', 'Ticket successfully re-assigned.');
    }

    public function edit($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);

        $it_personnel = ITPersonnel::all();
        $it_area = $it_personnel->pluck('it_area')->unique()->values();
        $sections_divisions = Divisions::pluck('sections_divisions')->toArray();
        $technical_services = TechnicalServices::pluck('technical_services')->toArray();

        return view('tickets.myrequested_tickets', compact(
            'ticket',
            'it_personnel',
            'it_area',
            'sections_divisions',
            'technical_services'
        ));
    }

    public function update(Request $request, $ticket_id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|max:255',
            'date_resolved' => 'required|date',
            'action_taken' => 'nullable|string',
            'photo' => 'nullable|image|max:10240',
        ]);

        $ticket = Tickets::findOrFail($ticket_id);

        $validatedData['date_resolved'] = Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('ticket_photos', 'public');
        }

        $ticket->update($validatedData);

        if ($ticket->email && $ticket->it_email) {
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

        return redirect()->route('myrequested_tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);

        if ($ticket->photo && Storage::disk('public')->exists($ticket->photo)) {
            Storage::disk('public')->delete($ticket->photo);
        }

        $ticket->delete();

        // Create notification
        $this->createNotification(
            $ticket,
            'ticket_deleted',
            "Ticket #{$ticketNumber} was deleted"
        );

        return redirect()->route('myrequested_tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
