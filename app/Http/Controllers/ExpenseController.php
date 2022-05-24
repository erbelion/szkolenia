<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $result = DB::select(DB::raw("SELECT DISTINCT SUBSTR(start_date,1,7) as Month, sum(price*users_count) AS Income from editions where SUBSTR(start_date,1,7)=SUBSTR(start_date,1,7) group by month"));

        return view('user.expenses', ['result' => $result]);
    }
}
