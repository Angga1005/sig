<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PointOfInterest;
use App\Models\Category;
use Validator;

class PointOfInterestController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id')->get();

        if (request()->ajax()) {
            return Datatables::of(PointOfInterest::orderBy('id', 'DESC')->get())
                ->addColumn('action', function($data){
                    return '<a class="btn btn-success" href="javascript:void(0)" id="edit" data-id="'.$data->id.'">Edit</a>
                            <a class="btn btn-danger" href="javascript:void(0)" id="delete" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }

        return view('admin.poi.index')->with(compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'category_id' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        PointOfInterest::create([
            'name' => $request->name,
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['success' => 'Data Added Successfully']);
    }

    public function edit(Request $request)
    {
        if (request()->ajax()) {
            $data = PointOfInterest::findOrFail($request->id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        $category = PointOfInterest::where('id', $request->hidden_id);
        $category->update([
            'name' => $request->name,
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        return response()->json(['success' => 'Update Data Successfully']);
    }

    public function destroy(Request $request)
    {
        $data = PointOfInterest::where('id', $request->id);
        $data->delete();

        return response()->json(['success' => 'Delete Data Successfully']);
    }
}
