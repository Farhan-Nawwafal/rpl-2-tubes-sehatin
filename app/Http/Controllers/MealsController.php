<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;
use App\Models\Users;


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

        $isExists = Meals::where('user_id', $userId)
            ->where('meal_type', $request->meal_type)
            ->where('date', $request->date)
            ->pluck('meal_type');

        if(!count($isExists)) {
            Meals::create([
                'date' => $request->date,
                'meal_type' => $request->meal_type,
                'user_id' => $userId,
            ]);
            return redirect()->route('input.data.page')->with(['success' => 'Berhasil Menambahkan Data Meals ' . $request->meal_type]);
        }

        return back()->withErrors(['meals_type' => 'Data ' . $request->meal_type . ' sudah ada!' ]);

    }
}
