<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Institution;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSectors = Sector::count();
        $totalInstitutions = Institution::count();

        return view('dashboard', compact('totalSectors', 'totalInstitutions'));
    }
}
