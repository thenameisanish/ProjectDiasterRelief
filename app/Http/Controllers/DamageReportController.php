<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DamageReportController extends Controller
{
    public function index()
    {
        $damages = DamageReport::latest()->get();
        return view('damages.index', compact('damages'));
    }

    public function create()
    {
        return view('damages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'infrastructure_type' => 'required|in:House,Road,Bridge,School,Hospital,Other',
            'quantity' => 'required|integer|min:1',
            'severity' => 'required|in:Minor,Major,Completely Destroyed',
            'description' => 'nullable|string|max:500',
        ]);

        DamageReport::create($validated);

        return redirect()->route('damages.index')->with('success', 'Damage assessment recorded successfully!');
    }

    public function destroy(DamageReport $damage)
    {
        $damage->delete();
        return redirect()->route('damages.index')->with('success', 'Damage record deleted.');
    }
        // Generate and Download PDF Report
    public function downloadPDF()
    {
        $damages = DamageReport::latest()->get();
        $pdf = Pdf::loadView('damages.pdf', compact('damages'));
        
        // Download the file with a custom name
        return $pdf->download('damage_assessment_report_' . date('Y-m-d') . '.pdf');
    }
}