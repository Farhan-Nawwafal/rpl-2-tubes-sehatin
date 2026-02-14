<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenTime;
use App\Models\Users;
use App\Services\ReminderService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ScreenTimeController extends Controller
{
    public function renderView()
    {
        return view('app.input-data');
    }

    public function saveScreenTimeData(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');
        $request->validate([
            'date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        // Validasi date yang diinput oleh pengguna
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

        // Mengecek apakah data screen time dengan date dan user id yang sama, sudah ada atau belum
        $isExist = ScreenTime::where('user_id', $userId)
            ->where('date', $request->date)->first();

        // Jika data belum ada, maka masukkan data baru
        if (empty($isExist)) {
            ScreenTime::create([
                'date' => $request->date,
                'duration' => $request->duration,
                'user_id' => $userId,
            ]);

            $reminderService = new ReminderService();

            $reminderService->generateReminder($userId, $request->date);

            return redirect()->route('input.data.page')->with(['success' => 'Berhasil input data screen time!']);
        }

        // Jika data sudah, maka update datanya
        $request->validate([
            'date' => 'required|date',
            'duration' => 'required|integer',
        ]);

        ScreenTime::where('id', $isExist->id)->update([
            'date' => $request->date,
            'duration' => $request->duration,
            'user_id' => $userId,
        ]);

        $reminderService = new ReminderService();

        $reminderService->generateReminder($userId, $request->date);

        return redirect()->route('input.data.page')->with(['success' => 'Berhasil update screen time']);
    }
}
