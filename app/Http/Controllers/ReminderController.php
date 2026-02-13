<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        // Ambil reminder milik user yang login, urutkan dari terbaru
        $reminders = Reminder::where('user_id', Auth::id())
                        ->orderBy('created_at', 'asc')
                        ->get();

        // Return ke view, kirim variable $reminders
        return view('app.reminder', compact('reminders'));
    }
}
