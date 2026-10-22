<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class HitungTotalSksController extends Controller
{
    public function __invoke()
    {
        $totalSks = Matakuliah::sum('sks');

        return "Total SKS seluruh mata kuliah: {$totalSks}";
    }
}