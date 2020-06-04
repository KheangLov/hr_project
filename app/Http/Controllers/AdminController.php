<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $count_all = count(User::all());
        $count_male = count(User::where('gender', 'male')->get());
        $count_female = count(User::where('gender', 'female')->get());
        return view('admin.dashboard', [
            'count_all' => $count_all,
            'count_male' => $count_male,
            'count_female' => $count_female,
        ]);
    }
}
