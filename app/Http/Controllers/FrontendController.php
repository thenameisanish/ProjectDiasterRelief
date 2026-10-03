<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\WeatherReport;
use Illuminate\Http\Request;
use App\Models\HoldingCenter;
use App\Models\DisasterReport;

class FrontendController extends Controller
{
    public function index()
    {
        $alerts = Alert::latest()->take(3)->get();
        $news = WeatherReport::latest()->take(3)->get();
        return view('frontend.home', compact('alerts', 'news'));
    }
public function searchShelters(Request $request)
{
    $shelters = HoldingCenter::all(); // Get all shelters
    return view('frontend.shelters', compact('shelters'));
}
public function checkAlert()
{
    $alert = Alert::latest()->first();
    return response()->json($alert);
}
    // Returns news as JSON for real-time user dashboard
    public function getNews()
    {
        $news = WeatherReport::latest()->take(3)->get();
        return response()->json($news);
    }
        // Show all news on a separate page
    public function newsIndex()
    {
        $news = WeatherReport::latest()->get();
        return view('frontend.news', compact('news'));
    }
        // Returns alerts as JSON for real-time user dashboard
    public function getLatestAlerts()
    {
        $alerts = Alert::latest()->take(3)->get();
        return response()->json($alerts);
    }
        // Show public disaster map
    public function disasterMap()
    {
        $disasters = DisasterReport::where('status', 'Active')->get(); // Only show active disasters to public
        return view('frontend.disaster_map', compact('disasters'));
    }
}
