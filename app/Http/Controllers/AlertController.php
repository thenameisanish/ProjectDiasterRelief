<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::latest()->get();
        return view('alerts.index', compact('alerts'));
    }

    public function create()
    {
        return view('alerts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'severity' => 'required|in:Info,Warning,Critical'
        ]);

        Alert::create($validated);

        return redirect()->route('alerts.index')->with('success', 'Alert broadcasted successfully!');
    }
}