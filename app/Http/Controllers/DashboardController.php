<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use App\Models\ScreenTime;
use App\Models\Sleep;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function renderVisualization(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->first()->id;

        $year = now()->year;


        $avgSleep = $this->calculateAvgSleep($userId);
        $screenTime = $this->calculateAvgScreenTime($userId);
        $screenTimeUser = $screenTime['screenTimeUser'];
        $avgScreenTime = $screenTime['avgScreenTime'];

        $mealData = $this->calculateMeals($userId);
        $totalMeals = $mealData['all']->count();
        $breakfast = $mealData['breakfast']->count();
        $lunch = $mealData['lunch']->count();
        $dinner = $mealData['dinner']->count();

        $lifestyleStatus = $this->getLifestyleStatus($avgSleep, $totalMeals, $avgScreenTime);
        $status = $lifestyleStatus['status'];
        $color = $lifestyleStatus['color'];

        return view('dashboard.index', compact('avgSleep', 'breakfast', 'lunch', 'dinner', 'avgScreenTime', 'screenTimeUser', 'year', 'status', 'color'));
    }

    public function calculateAvgSleep($userId)
    {
        $sleepsUser = Sleep::where('user_id', $userId)->get();
        $avgSleeps = $sleepsUser->avg('duration');
        return $avgSleeps;
    }

    public function calculateMeals($userId)
    {
        $allUserMeals = Meals::where('user_id', $userId)->get('meal_type');
        $breakfastUser = Meals::where('user_id', $userId)->where('meal_type', 'Breakfast')->get();
        $lunchUser = Meals::where('user_id', $userId)->where('meal_type', 'Lunch')->get();
        $dinnerUser = Meals::where('user_id', $userId)->where('meal_type', 'Dinner')->get();
        return [
            'all' => $allUserMeals,
            'breakfast' => $breakfastUser,
            'lunch' => $lunchUser,
            'dinner' => $dinnerUser,
        ];
    }

    public function calculateAvgScreenTime($userId)
    {
        $screenTimeUser = ScreenTime::where('user_id', $userId)->get();
        $avgScreenTime = $screenTimeUser->avg('duration');
        return [
            'screenTimeUser' => $screenTimeUser,
            'avgScreenTime' => $avgScreenTime,
        ];
    }

    public function getLifestyleStatus($avgSleep, $countUserMeals, $avgScreenTime)
    {
        $status = null;
        $color = null;
        if ($avgSleep >= 8 && $countUserMeals >= 17 && $avgScreenTime <= 8) {
            $status = 'Good';
            $color = 'bg-green-500';
        } else if (
            ($avgSleep >= 5 && $avgSleep < 8) &&
            ($countUserMeals >= 8 && $countUserMeals < 17) &&
            ($avgScreenTime > 8 && $avgScreenTime <= 10)
        ) {
            $status = 'Average';
            $color = 'bg-yellow-500';
        } else {
            $status = 'Bad';
            $color = 'bg-red-500';
        }

        return [
            'status' => $status,
            'color' => $color,
        ];
    }
}
