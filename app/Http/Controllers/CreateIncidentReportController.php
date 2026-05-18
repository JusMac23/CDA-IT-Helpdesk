<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatabreachForAssessment;
use App\Models\DataBreachNotification;
use App\Models\DatabreachTeam;
use App\Mail\IncidentSubmitted; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateIncidentReportController extends Controller
{
    // Handle Create
    public function create()
    {
        return view('databreach.create_incident');
    }

    // Handle Store
    public function store(Request $request)
    {
        // Validate user inputs
        $data = $request->validate([
            'sender_fullname'       => 'required|string|max:255',
            'sender_email'          => 'required|email|max:255',
            'date_occurrence'       => 'required|date',
            'date_discovery'        => 'required|date',
            'date_notification'     => 'required|date',
            'pic'                   => 'required|string|max:255',
            'brief_summary'         => 'required|string',
            'time_countdown'        => 'nullable|integer',
        ]);

        try {
            // Start a database transaction. 
            DB::beginTransaction();

            $data['status'] = 'For Assessment';
            $data['hundred_plus'] = 0;
            $data['email'] = $data['sender_email'];
            
            // Ensure time_countdown always has a default value
            $data['time_countdown'] = $request->input('time_countdown', 24); 

            $year = now()->year;
            
            // FIX: Added lockForUpdate() to prevent concurrent requests from generating duplicates
            $lastNumber = DatabreachForAssessment::whereYear('created_at', $year)
                ->orderBy('dbn_id', 'desc')
                ->lockForUpdate() 
                ->value('dbn_number');

            if ($lastNumber) {
                // Extract the number after the last '-'
                $lastSeq = (int) substr($lastNumber, strrpos($lastNumber, '-') + 1);
                $nextSeq = $lastSeq + 1;
            } else {
                $nextSeq = 1;
            }

            // Format to at least 2 digits (e.g., 01, 02... 99, 100)
            $formattedSeq = str_pad($nextSeq, 2, '0', STR_PAD_LEFT);
            $data['dbn_number'] = "CDA-DBN-{$year}-{$formattedSeq}";

            // Insert into the first table
            DatabreachForAssessment::create($data);
        
            // Insert into the second table using Eloquent
            DataBreachNotification::create([
                'dbn_number'            => $data['dbn_number'],
                'sender_fullname'       => $data['sender_fullname'],
                'sender_email'          => $data['sender_email'],
                'date_occurrence'       => $data['date_occurrence'],
                'date_discovery'        => $data['date_discovery'],
                'date_notification'     => $data['date_notification'],
                'pic'                   => $data['pic'],
                'brief_summary'         => $data['brief_summary'],
                'status'                => $data['status'],
                'time_countdown'        => $data['time_countdown'],
            ]);

            // Save the data to the database and release the lock
            DB::commit();

            // Attempt to send the email
            Mail::to($data['sender_email'])->send(new IncidentSubmitted($data));
            
            return redirect()->back()->with('success', "Incident report submitted successfully. Status: For Assessment.");

        } catch (Exception $e) {
            // Roll back the database changes and release the lock if an error occurs
            DB::rollBack();
            
            // Log the error for debugging
            Log::error('Incident Report Error: ' . $e->getMessage());
            
            // Redirect back with the exact error message
            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the report: ' . $e->getMessage());
        }
    }
}