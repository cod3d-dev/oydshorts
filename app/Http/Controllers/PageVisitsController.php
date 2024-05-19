<?php

namespace App\Http\Controllers;

use App\Models\PageVisits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageVisitsController extends Controller
{
    public function index()
    {
//        $visits = PageVisits::all();
//        $visits = DB::table('page_visits')->groupBy('ip')->get();
        $visits = PageVisits::select('ip', 'url')
            ->selectRaw('COUNT(ip) as count')
            ->groupBy('ip', 'url')
            ->get();
        // And return it as JSON

        return view('stats', compact('visits'));
//        return response()->json($visits);
    }
}
