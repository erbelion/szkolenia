<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $editions = DB::table('editions')->join('courses', 'courses.id', '=', 'editions.course_id')->select('editions.id', 'courses.title', 'courses.organiser_name', 'courses.organiser_url', 'courses.description as main_description', 'editions.subtitle', 'editions.description', 'editions.price', 'editions.edition_no', 'editions.users_count', 'editions.users_limit', 'editions.start_date', 'editions.end_date')->get();

        if(auth()->user())
            return view('user.home', ['editions' => $editions]);
        else
            return view('guest.home', ['editions' => $editions]);
    }
}
