<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Role;
use Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id')->get();
        if (request()->ajax()) {
            return Datatables::of(User::orderBy('id')->get())
                ->addColumn('action', function($data){
                    return '<a class="btn btn-success" href="javascript:void(0)" id="edit" data-id="'.$data->id.'">Edit</a>
                            <a class="btn btn-danger" href="javascript:void(0)" id="delete" data-id="'.$data->id.'">Delete</a>';
                })
                ->editColumn('role_id', function($drawings){
                    return $drawings->role->name;
                })
                ->make(true);
        }

        return view('admin.user.index')->with(compact('roles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return response()->json(['success' => 'Data Added Successfully']);
    }

    public function edit(Request $request)
    {
        if (request()->ajax()) {
            $data = User::findOrFail($request->id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        $email = $request->email;
        $password = $request->password;
        if ($email != '') {
            $data['email'] = $request->email;
        }
        if ($password != '') {
            $data['password'] = Hash::make($request->password);
        }
        $data['name'] = $request->name;
        $data['role_id'] = $request->role_id;

        $user = User::where('id', $request->hidden_id);
        $user->update($data);

        return response()->json(['success' => 'Update Data Successfully']);
    }

    public function destroy(Request $request)
    {
        $data = User::where('id', $request->id);
        $data->delete();

        return response()->json(['success' => 'Delete Data Successfully']);
    }
}
