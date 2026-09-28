<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisasterReport;
use App\Models\MissingPerson;
use App\Models\HoldingCenter;
use App\Models\Donation;
use App\Models\ReliefMaterial;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch Statistics
        $affectedAreas = DisasterReport::where('status', 'Active')->count();
        $lostLives = MissingPerson::where('status', 'Found Dead')->count();
        $missingPeople = MissingPerson::where('status', 'Missing')->count();
        $holdingCenters = HoldingCenter::count();
        $donations = Donation::sum('amount');
        $reliefMaterials = ReliefMaterial::count();

        return view('home', compact('affectedAreas', 'lostLives', 'missingPeople', 'holdingCenters', 'donations', 'reliefMaterials'));
    }
}