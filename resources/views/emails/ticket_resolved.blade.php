@component('mail::message')
# New Ticket Resolved

Hello {{ $ticket->it_personnel }},

This is a confirmation that the ticket has been successfully resolved.

Click the link below to upload your e-signature:

@component('mail::button', ['url' => route('tickets.personnel_signature', $ticket->ticket_id)])
Upload Signature
@endcomponent

**Ticket Number:** {{ $ticket->ticket_number }}  
**Name:** {{ $ticket->firstname }} {{ $ticket->lastname }}  
**Division:** {{ $ticket->division }}  
**Request:** {{ $ticket->request }}

Thanks,  
CDA Helpdesk System
@endcomponent
