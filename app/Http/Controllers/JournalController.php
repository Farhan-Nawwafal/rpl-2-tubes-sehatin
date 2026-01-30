<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class JournalController extends Controller
{
    public function index()
    {
        $journals = [""];

        return view('app.journal', compact('journals'));
    }
}
