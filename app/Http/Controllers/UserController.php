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
            'age' => 'required|string|email',
            'age' => 'required|int',
            'sex' => 'required|string|max:1',
            'password' => 'required|string|min:8'
        ]);

        Users::create([
            'username' => $request->username,
            'email' => $request->email,
            'age' => $request->age,
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

        $username = Users::where('username', $request->username)->value('username');
        if (Auth::attempt(['username' => strtolower($request->username), 'password' => strtolower($request->password)])) {
            $request->session()->regenerate();
            $request->session()->put('username', $username);
            return redirect()->route('dashboard')->with(['Success' => 'Berhasil Login!']);
        }

        return back()->withErrors(['username' => 'Username atau password Anda salah!']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with(['Success' => 'Berhasil Logout!']);
    }
}


