<?php

namespace App\Http\Controllers;

use App\Models\AidRequest;
use App\Models\ReliefMaterial;
use Illuminate\Http\Request;

class AidRequestController extends Controller
{
    public function index()
    {
        $aidRequests = AidRequest::latest()->get();
        return view('aid_requests.index', compact('aidRequests'));
    }

    public function create()
    {
        return view('frontend.aid_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requester_name' => 'nullable|string|max:255',
            'contact_number' => ['required', 'string', 'regex:/^(97|98)[0-9]{8}$/'],
            'location' => 'required|string|max:255',
            'resource_needed' => 'required|in:Food,Water,Medicine,Blanket,Tent,Clothing,Rescue',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|in:kg,bag,piece,bottle,box,litre,person',
        ]);

        $validated['requester_name'] = $validated['requester_name'] ?? 'Anonymous';
        $validated['status'] = 'Pending';

        // --- STRICT INVENTORY CHECK FOR ALL RESOURCES ---
        $categoryMap = [
            'Medicine' => 'Medical', 'Blanket' => 'Blanket', 'Tent' => 'Tent', 
            'Clothing' => 'Clothing', 'Food' => 'Food', 'Water' => 'Water',
            'Rescue' => 'Rescue'
        ];
        
        $reliefCategory = $categoryMap[$validated['resource_needed']] ?? 'Other';
        $totalStock = ReliefMaterial::where('category', $reliefCategory)->sum('quantity');

        // CHECK 1: If stock is 0 (or item doesn't exist at all)
        if ($totalStock <= 0) {
            return redirect()->back()->with('error', "Sorry, we currently have 0 {$validated['resource_needed']} in our inventory. Request denied.")->withInput();
        }

        // CHECK 2: If requested quantity is greater than available stock
        if ($validated['quantity'] > $totalStock) {
            return redirect()->back()->with('error', "Sorry, we only have {$totalStock} {$validated['unit']}s of {$validated['resource_needed']} in stock. Please request a lower amount.")->withInput();
        }

        AidRequest::create($validated);

        return redirect()->route('user.home')->with('success', 'Your aid request has been submitted!');
    }

    public function approve($id)
    {
        $aidRequest = AidRequest::findOrFail($id);
        
        $categoryMap = [
            'Medicine' => 'Medical', 'Blanket' => 'Blanket', 'Tent' => 'Tent', 
            'Clothing' => 'Clothing', 'Food' => 'Food', 'Water' => 'Water',
            'Rescue' => 'Rescue'
        ];
        
        $reliefCategory = $categoryMap[$aidRequest->resource_needed] ?? 'Other';
        $qtyToDeduct = $aidRequest->quantity;

        // Re-check stock before approving
        $totalStock = ReliefMaterial::where('category', $reliefCategory)->sum('quantity');

        if ($totalStock <= 0) {
            return redirect()->back()->with('error', "Cannot approve! We have 0 {$aidRequest->resource_needed} in stock.");
        }

        if ($qtyToDeduct > $totalStock) {
            return redirect()->back()->with('error', "Cannot approve! Insufficient stock. Requested: {$qtyToDeduct}, Available: {$totalStock}.");
        }

        // Deduct the stock
        $materials = ReliefMaterial::where('category', $reliefCategory)->where('quantity', '>', 0)->get();

        foreach ($materials as $material) {
            if ($qtyToDeduct <= 0) break;
            $deduct = min($material->quantity, $qtyToDeduct);
            $material->quantity -= $deduct;
            $material->save();
            $qtyToDeduct -= $deduct;
        }

        $aidRequest->status = 'Approved';
        $aidRequest->save();

        return redirect()->back()->with('success', 'Aid Request Approved. Stock has been deducted from inventory.');
    }
}