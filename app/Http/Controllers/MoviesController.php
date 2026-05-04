<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function fetchmovies(Request $request)
    {
        $records = Movie::all();
        return view('movies', compact('records'));
    }
}
