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
        $result = DB::select(DB::raw("SELECT subtitle, users_count as Students, users_count*price as Income from editions where start_date BETWEEN '$request->start_date' AND '$request->end_date'"));

        $sum = 0;
        foreach ($result as $row)
            $sum += $row->Income;

        return view('admin.raport_result', compact('result', 'sum'));
    }

}


