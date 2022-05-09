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
    
}


