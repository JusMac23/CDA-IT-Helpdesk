@component('mail::message')
<style>
    /* Import Figtree font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap');

    /* Apply Figtree font to all text elements */
    body, h1, h2, h3, h4, h5, h6, p, a, strong, em, span, div {
        font-family: 'Figtree', sans-serif !important;
    }

    /* Ensure the button also uses Figtree font */
    .button {
        font-family: 'Figtree', sans-serif !important;
        font-weight: 600;
        text-decoration: none;
    }
</style>

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

Thanks,  
CDA Helpdesk System
@endcomponent
