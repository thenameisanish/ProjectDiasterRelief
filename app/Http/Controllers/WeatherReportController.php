<?php

namespace App\Http\Controllers;

use App\Models\WeatherReport;
use Illuminate\Http\Request;

class WeatherReportController extends Controller
{
    // Show all news cards
    public function index()
    {
        $reports = WeatherReport::latest()->get();
        return view('weather.index', compact('reports'));
    }

    // Show form to create news
    public function create()
    {
        return view('weather.create');
    }

    // Store news with image
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('weather_images', 'public');
            $validated['image'] = $path;
        }

        WeatherReport::create($validated);

        return redirect()->route('weather.index')->with('success', 'Weather report published successfully!');
    }

    // Delete news
    public function destroy(WeatherReport $report)
    {
        $report->delete();
        return redirect()->route('weather.index')->with('success', 'Weather report deleted successfully!');
    }
}