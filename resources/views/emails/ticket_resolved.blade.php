@component('mail::message')
<style>
    /* Import Figtree font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap');

    /* Apply Figtree font to the entire email */
    body, h1, h2, h3, h4, h5, h6, p, a, strong, em, span, div {
        font-family: 'Figtree', sans-serif !important;
    }

    /* Customize button appearance */
    .button {
        font-family: 'Figtree', sans-serif !important;
        font-weight: 600;
        text-decoration: none;
    }
</style>

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
