@component('mail::message')
# New Ticket Resolved

Hello {{ $ticket->firstname . ' ' . $ticket->lastname }},

This is to inform you that your request has been successfully resolved.

We request that you upload your e-signature for confirmation. Please click the link below to proceed:

@component('mail::button', ['url' => route('tickets.client_signature', $ticket->ticket_id)])
Upload Signature
@endcomponent

**Ticket Number:** {{ $ticket->ticket_number }}  
**Name:** {{ $ticket->firstname }} {{ $ticket->lastname }}  
**Division:** {{ $ticket->division }}  
**Request:** {{ $ticket->request }}

Thanks,  
CDA Helpdesk System
@endcomponent
