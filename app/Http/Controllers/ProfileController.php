<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = (object) [
            'username' => 'MahasiswaTeknik',
            'email' => 'mahasiswa@heylth.com',
            'age' => 21,
            'sex' => 'L', // 'L' untuk Laki-laki, 'W' untuk Wanita
        ];
        return view('app.profile', ['user' => $user]);
    }
}
