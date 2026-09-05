<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Carbon\Carbon;
use App\Models\TechnicalServices;

class TechnicalServicesController extends Controller
{
    public function index(Request $request)
    {
        $query = TechnicalServices::query();

        if ($request->filled('search_query')) {
            $search = $request->search_query;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('technical_services', 'like', "%{$search}%")
                  ->orWhere('low', 'like', "%{$search}%")
                  ->orWhere('medium', 'like', "%{$search}%")
                  ->orWhere('high', 'like', "%{$search}%")
                  ->orWhere('critical', 'like', "%{$search}%")
                  ->orWhere('added_at', 'like', "%{$search}%")
                  ->orWhere('updated_at', 'like', "%{$search}%");
            });
        }

        $technical_services = $query->orderBy('id', 'asc')
                                   ->paginate(10)
                                   ->appends($request->all());

        return view('tech_services.index', compact('technical_services'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'technical_services'       => 'required|string|max:255',
            'low'      => 'nullable|string|max:255',
            'medium'   => 'nullable|string|max:255',
            'high'     => 'nullable|string|max:255',
            'critical' => 'nullable|string|max:255',
        ]);

        $validatedData['low']      = $validatedData['low'] ?? 'N/A';
        $validatedData['medium']   = $validatedData['medium'] ?? 'N/A';
        $validatedData['high']     = $validatedData['high'] ?? 'N/A';
        $validatedData['critical'] = $validatedData['critical'] ?? 'N/A';

        $validatedData['added_at'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        TechnicalServices::create($validatedData);

        return redirect()->route('tech_services.index')->with('success', 'Technical service successfully added.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'technical_services'       => 'required|string|max:255',
            'low'      => 'nullable|string|max:255',
            'medium'   => 'nullable|string|max:255',
            'high'     => 'nullable|string|max:255',
            'critical' => 'nullable|string|max:255',
        ]);

        $technical_services = TechnicalServices::findOrFail($id);

        $validatedData['low']      = $validatedData['low'] ?? 'N/A';
        $validatedData['medium']   = $validatedData['medium'] ?? 'N/A';
        $validatedData['high']     = $validatedData['high'] ?? 'N/A';
        $validatedData['critical'] = $validatedData['critical'] ?? 'N/A';

        $validatedData['updated_at'] = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');

        $technical_services->update($validatedData);

        return redirect()->route('tech_services.index')->with('success', 'Technical Service successfully updated.');
    }

    public function destroy($id)
    {
        $tech_services = TechnicalServices::findOrFail($id);
        $tech_services->delete();

        return redirect()->route('tech_services.index')->with('success', 'Service deleted successfully.');
    }
}