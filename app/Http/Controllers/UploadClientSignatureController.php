<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Tickets;

class UploadClientSignatureController extends Controller
{
    // Show Signature Form
    public function showSignatureForm($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);

        return view('tickets.client_signature', compact('ticket'));
    }

    // Save Signature
    public function saveSignature(Request $request, $ticket_id)
    {

        $request->validate([
            'client_signature' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $ticket = Tickets::findOrFail($ticket_id);

        // Store the signature image in 'public/client_signature'
        $path = $request->file('client_signature')->store('client_signature', 'public');

        $ticket->client_signature = $path;
        $ticket->save();

        return redirect()->route('tickets.client_signature', $ticket_id)
            ->with('success', 'Signature uploaded successfully.');
    }
}

