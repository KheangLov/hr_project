<?php

namespace App\Http\Controllers;

use App\User;
// use App\Charts\GenderChart;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // $borderColors = [
        //     "rgba(255, 99, 132, 1.0)",
        //     "rgba(22,160,133, 1.0)",
        //     "rgba(255, 205, 86, 1.0)",
        //     "rgba(51,105,232, 1.0)",
        //     "rgba(244,67,54, 1.0)",
        //     "rgba(34,198,246, 1.0)",
        //     "rgba(153, 102, 255, 1.0)",
        //     "rgba(255, 159, 64, 1.0)",
        //     "rgba(233,30,99, 1.0)",
        //     "rgba(205,220,57, 1.0)"
        // ];
        // $fillColors = [
        //     "rgba(255, 99, 132, 0.2)",
        //     "rgba(22,160,133, 0.2)",
        //     "rgba(255, 205, 86, 0.2)",
        //     "rgba(51,105,232, 0.2)",
        //     "rgba(244,67,54, 0.2)",
        //     "rgba(34,198,246, 0.2)",
        //     "rgba(153, 102, 255, 0.2)",
        //     "rgba(255, 159, 64, 0.2)",
        //     "rgba(233,30,99, 0.2)",
        //     "rgba(205,220,57, 0.2)"

        // ];
        // $genderChart = new GenderChart;

        $count_all = count(User::all());
        $count_male = count(User::where('gender', 'male')->get());
        $count_female = count(User::where('gender', 'female')->get());

        // $genderChart->minimalist(true);
        // $genderChart->labels(['Male', 'Female']);
        // $genderChart->dataset('All genders', 'doughnut', [$count_male, $count_female])
        //     ->color($borderColors)
        //     ->backgroundcolor($fillColors);

        return view('admin.dashboard', [
            'count_all' => $count_all,
            'count_male' => $count_male,
            'count_female' => $count_female,
            // 'genderChart' => $genderChart
        ]);
    }

    public function chartJson()
    {
        $count_all = count(User::all());
        $count_male = count(User::where('gender', 'male')->get());
        $count_female = count(User::where('gender', 'female')->get());

        return response()->json([
            'chart' => [
                'labels' => ['Male', 'Female']
            ],
            'datasets' => [
                [
                    'name' => 'Genders',
                    'values' => [$count_male, $count_female]
                ]
            ]
        ]);
    }
}
