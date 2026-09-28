<?php

namespace App\Http\Controllers;

use App\Models\ReliefMaterial;
use Illuminate\Http\Request;

class ReliefMaterialController extends Controller
{
    public function index()
    {
        $materials = ReliefMaterial::latest()->get();
        return view('relief.index', compact('materials'));
    }

    public function create()
    {
        return view('relief.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'category' => 'required|in:Food,Water,Medical,Tent,Clothing,Other',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:kg,bag,piece,bottle,box,litre'
        ]);

        ReliefMaterial::create($validated);
        return redirect()->route('relief.index')->with('success', 'Relief material added successfully!');
    }

    public function edit(ReliefMaterial $material)
    {
        return view('relief.edit', compact('material'));
    }

    public function update(Request $request, ReliefMaterial $material)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'category' => 'required|in:Food,Water,Medical,Tent,Clothing,Other',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:kg,bag,piece,bottle,box,litre'
        ]);

        $material->update($validated);
        return redirect()->route('relief.index')->with('success', 'Relief material updated successfully!');
    }

    public function destroy(ReliefMaterial $material)
    {
        $material->delete();
        return redirect()->route('relief.index')->with('success', 'Relief material deleted successfully!');
    }
}