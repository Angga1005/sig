<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfInterest;
use App\Models\Category;


class GuestController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('guest.index')->with(compact('categories'));
    }

    public function getLocation(Request $request)
    {
        // return dd($request->category_id);
        $query = PointOfInterest::with('category');
        if ($request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }
        $data = $query->orderBy('id', 'DESC')->get();

        return response()->json(['data' => $data]);
    }
}
