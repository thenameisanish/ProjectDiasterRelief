<?php

namespace App\Http\Controllers;

use App\Models\DisasterReport;
use Illuminate\Http\Request;

class DisasterReportController extends Controller
{
    public function index()
    {
        $reports = DisasterReport::latest()->get();
        return view('disasters.index', compact('reports'));
    }

    public function create()
    {
        return view('disasters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'disaster_type' => 'required|in:Flood,Earthquake,Fire,Landslide,Pandemic,Other',
            'description' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:Active,Contained,Resolved'
        ]);

        DisasterReport::create($validated);
        return redirect()->route('disasters.index')->with('success', 'Disaster reported successfully!');
    }

    public function edit(DisasterReport $disaster)
    {
        return view('disasters.edit', compact('disaster'));
    }

    public function update(Request $request, DisasterReport $disaster)
    {
        $validated = $request->validate([
            'disaster_type' => 'required|in:Flood,Earthquake,Fire,Landslide,Pandemic,Other',
            'description' => 'required|string|max:500',
            'status' => 'required|in:Active,Contained,Resolved'
        ]);

        $disaster->update($validated);
        return redirect()->route('disasters.index')->with('success', 'Disaster updated successfully!');
    }

    public function destroy(DisasterReport $disaster)
    {
        $disaster->delete();
        return redirect()->route('disasters.index')->with('success', 'Disaster deleted successfully!');
    }
}