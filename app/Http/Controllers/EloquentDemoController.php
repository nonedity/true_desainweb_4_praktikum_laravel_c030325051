<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class EloquentDemoController extends Controller
{
    public function bandingkan()
    {
        // Tanpa eager loading: N+1
        DB::flushQueryLog();
        DB::enableQueryLog();

        $lazy = Mahasiswa::limit(10)->get();
        foreach ($lazy as $m) {
            $m->nilai->count();   // 1 query tambahan per mahasiswa
        }
        $logLazy = DB::getQueryLog();

        // Dengan eager loading
        DB::flushQueryLog();

        $eager = Mahasiswa::with('nilai')->limit(10)->get();
        foreach ($eager as $m) {
            $m->nilai->count();   // data relasi sudah dimuat
        }
        $logEager = DB::getQueryLog();

        DB::disableQueryLog();

        return view('demo.eager-loading', compact('logLazy', 'logEager'));
    }
}