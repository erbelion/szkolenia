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

        // $result = DB::select(DB::raw("SELECT DISTINCT SUBSTR(start_date,1,7) as Month, sum(price) AS Income from editions INNER JOIN students ON students.edition_id=editions.id where SUBSTR(start_date,1,7)=SUBSTR(start_date,1,7) and students.id = '$user->id' group by month;"));

        // $result = $user->payments()->with('edition:id,start_date')->get()->each(function($payment){
        //     $payment->edition->start_date = date('Y-m', strtotime($payment->edition->start_date));
        // })->groupBy('edition.start_date')->each(function($month) use (&$sum){
        //     $month->sum = $month->sum('amount');
        //     $sum += $month->sum;
        // });

        $sum = 0;

        $result = $user->payments()->select('id', 'created_at', 'amount')->get()->each(function($payment){
            $payment->month = date('Y-m', strtotime($payment->created_at));
        })->groupBy('month');


        foreach ($result as $key => $value){
            $result[$key] = [
                'count' => count($result[$key]),
                'sum' => $value->sum('amount')
            ];
            $sum += $result[$key]['sum'];
        }

        $result = $result->toArray();

        return view('user.expenses', compact('result', 'sum'));
    }
}
