<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function fetchseries(Request $request)
    {
        $records = Series::all();
        return view('series', compact('records'));
    }
}
