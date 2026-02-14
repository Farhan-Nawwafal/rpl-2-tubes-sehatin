<?php

namespace App\Services;

use App\Models\Reminder;
use App\Models\Sleep;
use App\Models\Meals;
use App\Models\ScreenTime;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReminderService
{
    public function generateReminder($userId, $dateInput)
    {
        $date = Carbon::parse($dateInput)->format('Y-m-d');

        $sleepHoursDaily = Sleep::where('user_id', $userId)
            ->whereDate('date', $date)
            ->sum('duration');

        $eatDaily = Meals::where('user_id', $userId)
            ->whereDate('date', $date)
            ->count();
        // $eatDaily = 0;

        $screenTimeDaily = ScreenTime::where('user_id', $userId)
           ->whereDate('date', $date)
           ->sum('duration');
        // $screenTimeDaily = 0;

        $data = [
            'user_id' => $userId,
            'date' => $date,
        ];

        if ($sleepHoursDaily >= 8) {
            $data['sleep_status'] = "Good";
            $data['sleep_message'] = "Jam tidur kamu bagus, pertahankan!";
        } else {
            $data['sleep_status'] = "Bad";
            $data['sleep_message'] = "Coba tidur lebih awal supaya durasi tidurmu cukup.";
        }

        if ($eatDaily >= 2) {
            $data['eat_status'] = "Good";
            $data['eat_message'] = "Pola makan kamu baik, pertahankan!";
        } else {
            $data['eat_status'] = "Bad";
            $data['eat_message'] = "Jangan malas makan ya! Jumlah makan mu kurang";
        }

        if ($screenTimeDaily <= 8) {
            $data['screen_time_status'] = "Good";
            $data['screen_time_message'] = "Screen time kamu bagus, pertahankan!";
        } else {
            $data['screen_time_status'] = "Bad";
            $data['screen_time_message'] = "Kurangi waktu main hp kamu ya!";
        }

        // Kalau ketemu -> Update. Kalau gak ketemu -> Create baru.
        return Reminder::updateOrCreate(
            [
                'user_id' => $userId,
                'date' => $date
            ],
            $data
        );
    }
}
