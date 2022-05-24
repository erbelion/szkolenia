<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class RaportsController extends Controller

{
    public function query()
    {
        if(isset($_POST['submit'])){
            $startDate = $_POST['Start date'];
            echo "Start date: " .$startDate. "<br/>";
            $endDate = $_POST['End date'];
            echo "End date: " .$endDate. "<br/>";
        }
        $query = DB::select(DB::raw("select users_count, users_count*price as income from editions where start_date > '$startDate' && and end_date < '$endDate' RETURN users_count*price"));
    }

    public function query2()
    {
        $query = DB::select(DB::raw("SELECT DISTINCT SUBSTRING(start_date,1,7) as Month, 
        sum(price*users_count) AS Income from editions where SUBSTRING(start_date,1,7)=SUBSTRING(start_date,1,7) 
        group by month"));
    }
    
}


