<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Carbon\Carbon;
use App\Models\TechnicalServices;

class TechnicalServicesController extends Controller
{
    // Display Technical Services List
    public function index(Request $request)
    {
        // Start query
        $query = TechnicalServices::query();

        // Apply search if provided
        if ($request->filled('search_query')) {
            $search = $request->search_query;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('technical_services', 'like', "%{$search}%")
                  ->orWhere('added_at', 'like', "%{$search}%")
                  ->orWhere('updated_at', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $technical_services = $query->orderBy('id', 'asc')->paginate(20);

        return view('tech_services.index', compact('technical_services'));
    }

    // Add New Technical Service
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'technical_services' => 'required|string|max:255',
        ]);

        // Set created timestamp
        $validatedData['added_at'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        TechnicalServices::create($validatedData);

        return redirect()->route('tech_services.index')->with('success', 'Technical service successfully added.');
    }

    // Update Technical Service
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'technical_services' => 'required|string|max:255',
        ]);

        $technical_services = TechnicalServices::findOrFail($id);

        $validatedData['updated_at'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        $technical_services->update($validatedData);

        return redirect()->route('tech_services.index')->with('success', 'Technical Service successfully updated.');
    }

    // Delete Technical Service
    public function destroy($id)
    {
        $tech_services = TechnicalServices::findOrFail($id);
        $tech_services->delete();

        return redirect()->route('tech_services.index')->with('success', 'Service deleted successfully.');
    }
}
