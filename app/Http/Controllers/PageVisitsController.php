<?php

namespace App\Http\Controllers;

use App\Models\PageVisits;
use Illuminate\Http\Request;

class PageVisitsController extends Controller
{
    public function index()
    {
        $visits = PageVisits::all();

        // And return it as JSON
        return response()->json($visits);
    }
}
