<?php

namespace App\Http\Controllers;

use App\Services\ReminderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sleep;
use App\Models\Users;
use Carbon\Carbon;

class SleepController extends Controller
{

    public function renderView()
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

        // Validasi range
        if (
            $request->sleep_start < 0 ||
            $request->sleep_start >= 24 ||
            $request->sleep_end < 0 ||
            $request->sleep_end >= 24
        ) {
            return back()->withErrors(['sleep_start' => 'Invalid range from sleep_start or sleep_end']);
        }

        // Validasi date inputan
        $date = Carbon::parse($request->date);
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;

        $carbon = Carbon::now();
        if (
            $year > $carbon->year ||
            $month > $carbon->month ||
            $day > $carbon->day
        ) {
            return back()->withErrors(['date' => 'Invalid date range!']);
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

        $reminderService = new ReminderService();

        $reminderService->generateReminder($userId, $request->date);

        return redirect()->route('input.data.page')->with(['success' => 'Berhasil Menambahkan Data Sleep!']);
    }
}
