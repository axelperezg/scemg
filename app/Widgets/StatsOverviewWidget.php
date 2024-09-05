<?php
// app/Widgets/StatsOverviewWidget.php

namespace App\Widgets;

use App\Models\Sector;
use App\Models\Institution;

class StatsOverviewWidget
{
    public function render()
    {
        $totalSectors = Sector::count();
        $totalInstitutions = Institution::count();

        return view('widgets.stats-overview', compact('totalSectors', 'totalInstitutions'));
    }
}