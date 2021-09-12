<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfInterest;
use App\Models\Category;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $pois = PointOfInterest::select('category_id', DB::raw('count(*) AS count'))
                ->with('category')
                ->groupBy('category_id')
                ->get();
        $column = (12/$pois->count());
        return view('admin.dashboard')->with(compact('categories', 'pois', 'column'));
    }

    public function getLocation(Request $request)
    {
        $query = '';
        if (auth()->user()->id == 1) {
            $query = PointOfInterest::with('category');
            if ($request->category_id != null) {
                $query->where('category_id', $request->category_id);
            }
            $data = $query->orderBy('id', 'DESC')->get();
        } else {
            $query = PointOfInterest::with('category')->where('created_by', auth()->user()->id);
            if ($request->category_id != null) {
                $query->where('category_id', $request->category_id);
            }
            $data = $query->orderBy('id', 'DESC')->get();
        }

        return response()->json(['data' => $data]);
    }
}
