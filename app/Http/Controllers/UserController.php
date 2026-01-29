<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3',
            'email' => 'required|string|email',
            'sex' => 'required|string|max:1',
            'password' => 'required|string|min:8'
        ]);

        Users::create([
            'username' => $request->username,
            'email' => $request->email,
            'sex' => $request->sex,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with(['Success' => 'Data Berhasil Disimpan!']);
    }

    public function getUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['username' => strtolower($request->username), 'password' => strtolower($request->password)])) {
            return redirect()->route('dashboard')->with(['Success' => 'Berhasil Login!']);
        }

        return back()->withErrors(['username' => 'Username atau password Anda salah!']);
    }
}
