<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sleep;
use App\Models\Users;

class SleepController extends Controller
{

    public function create()
    {
        return view('app.input-data');
    }

    public function saveSleepData(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');
        $request->validate([
            'date' => 'required|date',
            'sleep_start' => 'required|integer',
            'sleep_end' => 'required|integer',
        ]);

        if (
            $request->sleep_start < 0 ||
            $request->sleep_start >= 24 ||
            $request->sleep_end < 0 ||
            $request->sleep_end >= 24
        ) {
            return back()->withErrors(['sleep_start' => 'Invalid range from sleep_start or sleep_end']);
        }

        // Hitung durasi
        $sleepDuration = $request->sleep_end - $request->sleep_start;
        if ($sleepDuration < 0) $sleepDuration += 24;
        if ($request->sleep_start == $request->sleep_end) $sleepDuration = 0;

        Sleep::create([
            'date' => $request->date,
            'sleep_start' => intval($request->sleep_start),
            'sleep_end' => intval($request->sleep_end),
            'duration' => $sleepDuration,
            'user_id' => $userId,
        ]);
        return redirect()->route('input.data.page')->with(['success' => 'Berhasil Menambahkan Data Sleep!']);
    }
}
