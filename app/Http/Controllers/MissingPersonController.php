<?php

namespace App\Http\Controllers;

use App\Models\MissingPerson;
use Illuminate\Http\Request;

class MissingPersonController extends Controller
{
    public function index()
    {
        $missingPeople = MissingPerson::latest()->get();
        return view('missing.index', compact('missingPeople'));
    }

    public function create()
    {
        return view('missing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'age' => 'required|integer|min:1|max:95',
            'gender' => 'required|in:Male,Female,Other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'last_seen_location' => 'required|string|max:255',
            'status' => 'required|in:Missing,Found Alive,Found Dead'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('missing_people', 'public');
            $validated['image'] = $path;
        }

        MissingPerson::create($validated);

        return redirect()->route('missing.index')->with('success', 'Person added successfully!');
    }

    // 1. SHOW EDIT FORM
    public function edit(MissingPerson $person)
    {
        return view('missing.edit', compact('person'));
    }

    // 2. HANDLE UPDATE SUBMIT
    public function update(Request $request, MissingPerson $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'age' => 'required|integer|min:1|max:95',
            'gender' => 'required|in:Male,Female,Other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'last_seen_location' => 'required|string|max:255',
            'status' => 'required|in:Missing,Found Alive,Found Dead'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('missing_people', 'public');
            $validated['image'] = $path;
        }

        $person->update($validated);

        return redirect()->route('missing.index')->with('success', 'Person record updated successfully!');
    }

    // 3. HANDLE DELETE
    public function destroy(MissingPerson $person)
    {
        $person->delete();
        return redirect()->route('missing.index')->with('success', 'Person record deleted successfully!');
    }
}