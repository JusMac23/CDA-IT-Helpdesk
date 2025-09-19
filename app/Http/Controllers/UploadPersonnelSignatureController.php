<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Tickets;

class UploadPersonnelSignatureController extends Controller
{
    // Show Signature Form
    public function showSignatureForm($ticket_id)
    {
        $ticket = Tickets::findOrFail($ticket_id);

        return view('tickets.personnel_signature', compact('ticket'));
    }

    // Save Signature
    public function saveSignature(Request $request, $ticket_id)
    {
        $request->validate([
            'personnel_signature' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $ticket = Tickets::findOrFail($ticket_id);

        // Store the signature image
        $path = $request->file('personnel_signature')->store('personnel_signature', 'public');

        $ticket->personnel_signature = $path;
        $ticket->save();

        return redirect()->route('tickets.personnel_signature', $ticket_id)
            ->with('success', 'Signature uploaded successfully.');
    }
}

