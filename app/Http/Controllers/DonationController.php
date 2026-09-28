<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->get();
        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'donor_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
    'type' => 'required|in:Cash,Item',
    'amount' => 'required|numeric|min:0', 
    'item_description' => 'required|string|max:255',
]);
        Donation::create($validated);
        return redirect()->route('donations.index')->with('success', 'Donation recorded successfully!');
    }

    public function edit(Donation $donation)
    {
        return view('donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
       $validated = $request->validate([
    'donor_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
    'type' => 'required|in:Cash,Item',
    'amount' => 'required|numeric|min:0', 
    'item_description' => 'required|string|max:255',
]);

        $donation->update($validated);
        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }
}