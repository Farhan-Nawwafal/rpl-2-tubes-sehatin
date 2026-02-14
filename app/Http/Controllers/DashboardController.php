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
        $userId = Users::where('username', $username)->first()->id;

        $year = now()->year;

        $sleepsUser = Sleep::where('user_id', $userId)->get();
        $allUserMeals = Meals::where('user_id', $userId)->get('meal_type');
        $breakfastUser = Meals::where('user_id', $userId)->where('meal_type', 'Breakfast')->get();
        $lunchUser = Meals::where('user_id', $userId)->where('meal_type', 'Lunch')->get();
        $dinnerUser = Meals::where('user_id', $userId)->where('meal_type', 'Dinner')->get();
        $screenTimeUser = ScreenTime::where('user_id', $userId)->get();

        $avgSleeps = $sleepsUser->avg('duration');
        $countBreakfast = $breakfastUser->count();
        $countLunch = $lunchUser->count();
        $countDinner = $dinnerUser->count();
        $avgScreenTime = $screenTimeUser->avg('duration');

        $status = null;
        $color = null;
        $countUserMeals = $allUserMeals->count();
        if ($avgSleeps >= 8 && $countUserMeals >= 17 && $avgScreenTime <= 8) {
            $status = 'Good';
            $color = 'bg-green-500';
        } else if (
            ($avgSleeps >= 5 && $avgSleeps < 8) &&
            ($countUserMeals >= 8 && $countUserMeals < 17) &&
            ($avgScreenTime > 8 && $avgScreenTime <= 10)
        ) {
            $status = 'Average';
            $color = 'bg-yellow-500';
        } else {
            $status = 'Bad';
            $color = 'bg-red-500';
        }

        return view('dashboard.index', compact('screenTimeUser', 'avgSleeps', 'countBreakfast', 'countLunch', 'countDinner', 'avgScreenTime', 'year', 'status', 'color'));
    }
}
