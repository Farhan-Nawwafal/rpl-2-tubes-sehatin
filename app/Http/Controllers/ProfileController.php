<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->session()->get('username');
        $activeUser = Users::where('username', $username)->first();
        return view('app.profile', [
            'username' => $activeUser->username,
            'email' => $activeUser->email,
            'sex' => $activeUser->sex,
            'age' => $activeUser->age,
        ]);
    }
}
