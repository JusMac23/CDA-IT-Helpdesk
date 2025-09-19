<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Carbon\Carbon;
use App\Models\ITPersonnel;
use App\Models\RegionEmail;

class TechnicalPersonnelController extends Controller
{
    // Display Technical Personnel List
    public function index(Request $request)
    {
        $query = ITPersonnel::orderBy('it_area', 'asc');
        $region = RegionEmail::pluck('region')->toArray();

        if ($request->filled('search_query')) {
            $search = $request->search_query;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('firstname', 'like', "%{$search}%")
                  ->orWhere('middle_initial', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('it_email', 'like', "%{$search}%")
                  ->orWhere('it_area', 'like', "%{$search}%")
                  ->orWhere('date_added', 'like', "%{$search}%")
                  ->orWhere('date_updated', 'like', "%{$search}%");
            });
        }

        $technical_personnel = $query->paginate(20);

        return view('tech_personnel.index', compact('technical_personnel', 'region'));
    }

    // Add New Technical Personnel
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname'       => 'required|string|max:255',
            'middle_initial'  => 'nullable|string|max:10',
            'lastname'        => 'required|string|max:255',
            'it_email'        => 'required|email|max:255',
            'it_area'         => 'required|string|max:255',
            'date_added'      => 'required|date',
        ]);

        $validatedData['date_added'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        ITPersonnel::create($validatedData);

        return redirect()->route('tech_personnel.index')->with('success', 'Technical Personnel successfully added.');
    }

    // Update Technical Personnel
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname'       => 'required|string|max:255',
            'middle_initial'  => 'nullable|string|max:10',
            'lastname'        => 'required|string|max:255',
            'it_email'        => 'required|email|max:255',
            'it_area'         => 'required|string|max:255',
        ]);

        $validatedData['date_updated'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        $technical_personnel = ITPersonnel::findOrFail($id);
        $technical_personnel->update($validatedData);

        return redirect()->route('tech_personnel.index')->with('success', 'Technical Personnel successfully updated.');
    }

    // Delete Personnel
    public function destroy($id)
    {
        $tech_personnel = ITPersonnel::findOrFail($id);
        $tech_personnel->delete();

        return redirect()->route('tech_personnel.index')->with('success', 'Personnel deleted successfully.');
    }
}
