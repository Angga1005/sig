<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfInterest;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getLocation(Request $request)
    {
        $query = '';
        if (auth()->user()->id == 1) {
            $query = PointOfInterest::all();
        } else {
            $query = PointOfInterest::where('created_by', auth()->user()->id)->get();
        }

        return response()->json(['data' => $query]);
    }
}
