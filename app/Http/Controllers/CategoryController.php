<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            return Datatables::of(Category::orderBy('id')->get())
                ->addColumn('action', function($data){
                    return '<a class="btn btn-success" href="javascript:void(0)" id="edit" data-id="'.$data->id.'">Edit</a>
                            <a class="btn btn-danger" href="javascript:void(0)" id="delete" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }

        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'icon_url' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        Category::create([
            'name' => $request->name,
            'icon_url' => $request->icon_url
        ]);

        return response()->json(['success' => 'Data Added Successfully']);
    }

    public function edit(Request $request)
    {
        if (request()->ajax()) {
            $data = Category::findOrFail($request->id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'icon_url' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        $category = Category::where('id', $request->hidden_id);
        $category->update([
            'name' => $request->name,
            'icon_url' => $request->icon_url
        ]);

        return response()->json(['success' => 'Update Data Successfully']);
    }

    public function destroy(Request $request)
    {
        $data = Category::where('id', $request->id);
        $data->delete();

        return response()->json(['success' => 'Delete Data Successfully']);
    }
}
