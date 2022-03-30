<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function index($id)
    {
        return view('singles.edition', [
            'edition' => Edition::find($id)
        ]);
    }
}
