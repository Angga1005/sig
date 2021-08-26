<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfInterest;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getLocation(Request $request)
    {
        $query = PointOfInterest::all();

        return response()->json(['data' => $query]);
    }
}
