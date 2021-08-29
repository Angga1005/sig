<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfInterest;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function getLocation(Request $request)
    {
        $query = PointOfInterest::all();
        return response()->json(['data' => $query]);
    }
}
