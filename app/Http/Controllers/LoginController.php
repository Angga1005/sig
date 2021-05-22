<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
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

        return redirect()->route('admin.dashboard');
    }
        public function logout()
        {
            Auth::logout();

            return redirect()->route('admin.dashboard');;
        }
}
