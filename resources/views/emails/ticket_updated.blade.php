@component('mail::message')
<style>
    /* Import Figtree font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap');

    /* Apply Figtree font globally to all elements */
    body, h1, h2, h3, h4, h5, h6, p, a, strong, em, span, div {
        font-family: 'Figtree', sans-serif !important;
    }

    /* Ensure buttons use Figtree as well */
    .button {
        font-family: 'Figtree', sans-serif !important;
        font-weight: 600;
        text-decoration: none;
    }
</style>

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
