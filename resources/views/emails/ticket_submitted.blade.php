@component('mail::message')
<style>
    /* Import Figtree font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap');

    /* Apply Figtree font globally */
    body, h1, h2, h3, h4, h5, h6, p, a, strong, em, span, div {
        font-family: 'Figtree', sans-serif !important;
    }

    /* Style for the mail button */
    .button {
        font-family: 'Figtree', sans-serif !important;
        font-weight: 600;
        text-decoration: none;
    }
</style>

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

Thanks,  
CDA Helpdesk System
@endcomponent
