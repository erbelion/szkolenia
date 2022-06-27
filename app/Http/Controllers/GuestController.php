<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    public function index()
    {
        return view('guests', ['guests' => Guest::select('name', 'message')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'review' => 'required',
        ]);

        Guest::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'name' => $request->user_name,
            'message' => $request->review,
        ]);

        return redirect()->back()->with('message', 'Dodano komentarz' . $request->title);
    }
}
