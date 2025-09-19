@component('mail::message')
# New Ticket Assigned

Hello {{ $ticket->it_personnel }},

A new ticket has been submitted and assigned to you.

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
