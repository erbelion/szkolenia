<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class RaportsController extends Controller

{
    public function generateReports()
    {
        return view('admin.raports');
    }

    public function earnings(Request $request)
    {
        $query = DB::select(DB::raw("SELECT subtitle, users_count as Students, users_count*price as Income from editions where start_date BETWEEN '$request->start_date' AND '$request->end_date'"));

        dd($query);


    }

    // public function query2()
    // {
    //     $query = DB::select(DB::raw("SELECT DISTINCT SUBSTRING(start_date,1,7) as Month, 
    //     sum(price*users_count) AS Income from editions where SUBSTRING(start_date,1,7)=SUBSTRING(start_date,1,7) 
    //     group by month"));
    // }
    
}


