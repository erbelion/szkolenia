<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class ExpenseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        $result = DB::select(DB::raw("SELECT DISTINCT SUBSTR(start_date,1,7) as Month, sum(price) AS Income from editions INNER JOIN students ON students.edition_id=editions.id where SUBSTR(start_date,1,7)=SUBSTR(start_date,1,7) and students.id = '$user->id' group by month;"));
        return view('user.expenses', ['result' => $result]);
    }
}
