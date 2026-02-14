<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function showReminder(Request $request)
    {
        // Ambil reminder milik user yang login, urutkan dari terbaru
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->first()->id;
        $reminders = Reminder::where('user_id', $userId)
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('app.reminder', compact('reminders'));
    }
}
