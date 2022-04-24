<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Place;
use App\Models\Edition;
use App\Models\Student;

class MeetingController extends Controller
{
    public function index($id)
    {
        $title = Meeting::findOrFail($id)->title;
        $description = Meeting::findOrFail($id)->description;
        $start_date = Meeting::findOrFail($id)->start_date;
        $end_date = Meeting::findOrFail($id)->end_date;
        $place_id = Meeting::findOrFail($id)->place_id;
        $edition_id = Meeting::findOrFail($id)->edition_id;

        $place = Meeting::with('place')->findOrFail($id);

        $isUserStudent = Meeting::with('edition')->findOrFail($edition_id)->edition->isUserStudent();
        if(!$isUserStudent) return redirect()->back()->with('errorMessage', 'Nie jesteś studentem tej edycji');



        return view('singles.meeting', [
            'title' => $title,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,

            'country' => $place->place->country,
            'city' => $place->place->city,
            'postal_code' => $place->place->postal_code,
            'street_name' => $place->place->street_name,
            'street_number' => $place->place->street_number,
            'apartment_number' => $place->place->apartment_number,
            'room' => $place->place->room,
        ]);
    }
}
