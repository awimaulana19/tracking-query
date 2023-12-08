<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/wilayah');
        }

        return back()->with([
            'pesan-danger' => 'Username atau password anda salah',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
