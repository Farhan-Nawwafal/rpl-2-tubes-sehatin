<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;
use App\Models\Users;
use Carbon\Carbon;

class MealsController extends Controller
{
    public function create()
    {
        return view('app.input-data');
    }

    public function saveMealsData(Request $request)
    {

        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');


        $request->validate([
            'date' => 'required|date',
            'meal_type' => 'required|string',
        ]);

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

        $isExists = Meals::where('user_id', $userId)
            ->where('meal_type', $request->meal_type)
            ->where('date', $request->date)
            ->pluck('meal_type');

        if (!count($isExists)) {
            Meals::create([
                'date' => $request->date,
                'meal_type' => $request->meal_type,
                'user_id' => $userId,
            ]);
            return redirect()->route('input.data.page')->with(['success' => 'Berhasil Menambahkan Data Meals ' . $request->meal_type]);
        }

        return back()->withErrors(['meals_type' => 'Data ' . $request->meal_type . ' sudah ada!']);
    }
}
