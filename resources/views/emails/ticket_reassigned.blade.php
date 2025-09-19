@component('mail::message')
# New Ticket Re-Assigned

Hello {{ $ticket->assigned_to }},

<p>A new ticket has been re-assigned to you by <strong>{{ Auth::user()->name }}</strong>.</p>

<p>Please check the details below and take the necessary action.</p>

**Ticket Number:** {{ $ticket->ticket_number }}  
**Name:** {{ $ticket->firstname }} {{ $ticket->lastname }}  
**Division:** {{ $ticket->division }}  
**Request:** {{ $ticket->request }}

@component('mail::button', ['url' => url('/login')])
View Dashboard
@endcomponent

Thanks,<br>
CDA Helpdesk System
@endcomponent
