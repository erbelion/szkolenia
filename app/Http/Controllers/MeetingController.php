<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Place;
use App\Models\Edition;
use App\Models\Student;
use App\Models\Comment;
use App\Models\User;

class MeetingController extends Controller
{
    public function index($id)
    {
        $meeting = Meeting::findOrFail($id);
        $title = $meeting->title;
        $description = $meeting->description;
        $start_date = $meeting->start_date;
        $end_date = $meeting->end_date;
        $place_id = $meeting->place_id;
        $edition_id = $meeting->edition_id;
        $place = Place::where('id', $place_id)->findOrFail($place_id);
        $commentTable = Comment::all();
        $user = auth()->user();

        if(!$user || ($user->rank != 1 && !Meeting::with('edition')->findOrFail($edition_id)->edition->isUserStudent()))
            return redirect()->back()->with('errorMessage', 'Nie jesteś studentem tej edycji');



        return view('singles.meeting', [
            'id'=> $id,
            'title' => $title,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,

            'country' => $place->country,
            'city' => $place->city,
            'postal_code' => $place->postal_code,
            'street_name' => $place->street_name,
            'street_number' => $place->street_number,
            'apartment_number' => $place->apartment_number,
            'room' => $place->room,

            'comments' => $commentTable,
        ]);
    }
    //Comment store
    public function store(Request $request, $id)
    {

        Comment::create([
            'meeting_id'=> $id,
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'message' => $request->review,
        ]);

        return redirect()->back()->with('message', 'Dodano komentarz' . $request->title);
    }
}
