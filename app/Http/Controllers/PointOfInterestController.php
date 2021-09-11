<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PointOfInterest;
use App\Models\Category;
use Validator;
use Auth;

class PointOfInterestController extends Controller
{
    public function index(Request $request)
    {
        $query = '';
        if (auth()->user()->id == 1) {
            $query = PointOfInterest::orderBy('id', 'DESC')->get();
        } else {
            $query = PointOfInterest::where('created_by', auth()->user()->id)->orderBy('id', 'DESC')->get();
        }

        $categories = Category::orderBy('id')->get();

        if (request()->ajax()) {
            return Datatables::of($query)
                ->addColumn('action', function($data){
                    return '<a class="btn btn-success" href="javascript:void(0)" id="edit" data-id="'.$data->id.'">Edit</a>
                            <a class="btn btn-danger" href="javascript:void(0)" id="delete" data-id="'.$data->id.'">Delete</a>';
                })
                ->editColumn('category_id', function($drawings) {
                    return $drawings->category->name;
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
            'phone' => 'required',
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
            'phone' => $request->phone,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'category_id' => $request->category_id,
            'created_by' => auth()->user()->id,
            'description' => $request->description
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        $category = PointOfInterest::where('id', $request->hidden_id);
        $category->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'category_id' => $request->category_id,
            'description' => $request->description
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
