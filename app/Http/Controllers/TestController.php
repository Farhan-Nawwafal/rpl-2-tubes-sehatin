<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showMahasiswa()
    {
        $mahasiswa = [
            [
                "nama" => "Farhan Nawwafal",
                "kelas" => "IF4",
                "angkatan" => 2023,
            ],
            [
                "nama" => "Rafli Pramudiafa",
                "kelas" => "2C",
                "angkatan" => 2024
            ]
        ];

        return view('auth.register', compact('mahasiswa'));
    }
}
