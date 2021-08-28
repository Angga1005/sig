<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers;
use App\Models\User;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function credentials(Request $request)
    {
        // return dd($request->email);
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['error' => 'Email/Password Yang Anda Masukan Salah!']);
        }

        return redirect()->route('dashboard');
    }
    
    public function logout()
    {
        Auth::logout();

        return redirect()->route('dashboard');;
    }

    public function register()
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->messages()]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        return redirect()->route('login')->with('success','Berhasil register akun!');
    }
}
