<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = [
            (object) [
                'id' => 1,
                'dayText' => 'Monday',
                'dayNumber' => 29,
                'month' => 'January',
                'year' => 2026,

                // Status Good
                'sleepMessage' => 'You slept well! Keep it up.',
                'sleepStatus' => 'good',

                // Status Bad
                'eatMessage' => 'You skipped breakfast. Try to eat regularly.',
                'eatStatus' => 'bad',

                // Status Good
                'screenTimeMessage' => 'Your screen time is balanced.',
                'screenTimeStatus' => 'good',
            ],
            (object) [
                'id' => 2,
                'dayText' => 'Sunday',
                'dayNumber' => 28,
                'month' => 'January',
                'year' => 2026,

                'sleepMessage' => 'You only slept 4 hours.',
                'sleepStatus' => 'bad',

                'eatMessage' => 'Great job eating 3 meals a day!',
                'eatStatus' => 'good',

                'screenTimeMessage' => 'High screen time detected.',
                'screenTimeStatus' => 'bad',
            ],
        ];


        return view('app.reminder', ['reminders' => $reminders]);
    }
}
