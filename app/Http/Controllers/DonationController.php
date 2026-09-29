<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // Admin: View all donations made by users
    public function index()
    {
        $donations = Donation::latest()->get();
        return view('donations.index', compact('donations'));
    }

    // Admin: Generate and Download CSV Report
    public function exportCsv()
    {
        $donations = Donation::all();
        $fileName = 'donations_report_' . date('Y-m-d') . '.csv';
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Donor Name', 'Type', 'Amount (Rs)', 'Message', 'Date Recorded'];

        $callback = function() use($donations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->donor_name,
                    $donation->type,
                    $donation->amount,
                    $donation->item_description ?? 'N/A',
                    $donation->created_at->format('Y-m-d H:i:s')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Admin: Edit (Optional, but good to keep)
    public function edit(Donation $donation)
    {
        return view('donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'amount' => 'required|numeric|min:1',
            'item_description' => 'nullable|string|max:255',
        ]);
        $validated['type'] = 'Cash';
        $donation->update($validated);
        
        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }

    // User: Show donation form
    public function create()
    {
        return view('donations.create');
    }

    // User: Store donation
   public function store(Request $request)
{
    $validated = $request->validate([
        'donor_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
        'amount' => 'required|numeric|min:1',
        'transaction_id' => 'required|string|max:255',
        'item_description' => 'nullable|string|max:255',
    ]);
    
    $validated['type'] = 'Cash';
    $validated['status'] = 'pending'; // Set status to pending

    Donation::create($validated);

    return redirect()->route('user.home')->with('success', 'Thank you! Your donation is pending admin verification.');
}
// Admin: Verify Donation
public function verify($id)
{
    $donation = Donation::findOrFail($id);
    $donation->status = 'verified';
    $donation->save();

    return redirect()->back()->with('success', 'Donation verified successfully!');
}
    // Returns donations as JSON for real-time table
    public function getDonations()
    {
        return response()->json(Donation::latest()->get());
    }
}