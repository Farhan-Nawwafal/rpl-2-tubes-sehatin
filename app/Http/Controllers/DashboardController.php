<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use App\Models\ScreenTime;
use App\Models\Sleep;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function render(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');

        $sleepsUser = Sleep::where('user_id', $userId)->get();
        $breakfastUser = Meals::where('user_id', $userId)->where('meal_type', 'Breakfast')->get();
        $lunchUser = Meals::where('user_id', $userId)->where('meal_type', 'Lunch')->get();
        $dinnerUser = Meals::where('user_id', $userId)->where('meal_type', 'Dinner')->get();
        $screenTimeUser = ScreenTime::where('user_id', $userId)->get();
        $avgSleeps = $sleepsUser->avg('duration');
        $countBreakfast = $breakfastUser->count();
        $countLunch = $lunchUser->count();
        $countDinner = $dinnerUser->count();
        $avgScreenTime = $screenTimeUser->avg('duration');


        return view('dashboard.index', compact('avgSleeps', 'countBreakfast', 'countLunch', 'countDinner', 'avgScreenTime'));
    }
}
