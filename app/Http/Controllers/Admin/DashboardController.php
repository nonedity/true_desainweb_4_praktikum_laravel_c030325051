<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return 'Ini adalah Dashboard Admin (controller di dalam sub-folder Admin)';
    }
}