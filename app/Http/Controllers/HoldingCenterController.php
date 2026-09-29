<?php

namespace App\Http\Controllers;

use App\Models\HoldingCenter;
use Illuminate\Http\Request;

class HoldingCenterController extends Controller
{
    public function index()
    {
        $shelters = HoldingCenter::latest()->get();
        return view('shelters.index', compact('shelters'));
    }

    public function create()
    {
        return view('shelters.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'capacity' => 'required|integer|min:1'
    ]);

    HoldingCenter::create($validated);
    return redirect()->route('shelters.index')->with('success', 'Holding Center added successfully!');
}
}