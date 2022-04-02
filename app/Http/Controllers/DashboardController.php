<?php

namespace App\Http\Controllers;

use App\Models\Edition;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user())
            return view('user.home', ['editions' => Edition::getAllEditions()]);
        else
            return view('guest.home', ['editions' => Edition::getAllEditions()]);
    }
}
