<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Role;
use Validator;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            return Datatables::of(Role::orderBy('id')->get())
                ->addColumn('action', function($data){
                    return '<a class="btn btn-success" href="javascript:void(0)" id="edit" data-id="'.$data->id.'">Edit</a>
                            <a class="btn btn-danger" href="javascript:void(0)" id="delete" data-id="'.$data->id.'">Delete</a>';
                })
                ->make(true);
        }

        return view('admin.role.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json(['success' => 'Data Added Successfully']);
    }

    public function edit(Request $request)
    {
        if (request()->ajax()) {
            $data = Role::findOrFail($request->id);
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

        $role = Role::where('id', $request->hidden_id);
        $role->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json(['success' => 'Update Data Successfully']);
    }

    public function destroy(Request $request)
    {
        $data = Role::where('id', $request->id);
        $data->delete();

        return response()->json(['success' => 'Delete Data Successfully']);
    }
}
