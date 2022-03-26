<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Course;
use App\Models\Edition;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function courses()
    {
        return view('admin.courses', [
            'courses' => Course::paginate(10)
        ]);
    }

    public function newCourse(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'organiser_name' => 'required',
            'organiser_url' => 'required',
            'description' => 'required',
            'editions_limit' => 'required|integer|min:1',
        ]);

        Course::create(Course::simpleDataArray($request));

        return redirect()->back()->with('message', 'Utworzono kurs ' . $request->title);
    }

    public function editions($id)
    {
        return view('admin.editions', [
            'editions' => Edition::where('course_id', $id)->paginate(10),
            'course_id' => $id
        ]);
    }

    public function newEdition(Request $request, $id)
    {
        $request->validate([
            'subtitle' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:1',
            'users_limit' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $newEditionNo = Edition::where('course_id', $id)->count() + 1;

        if($newEditionNo > Course::find($id)->editions_limit)
            return redirect()->back()->with('errorMessage', 'Nie utworzono edycji - przekroczono limit');

        Edition::create([
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'price' => $request->price,
            'users_limit' => $request->users_limit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'edition_no' => $newEditionNo,
            'course_id' => $id,
        ]);

        return redirect()->back()->with('message', 'Utworzono edycję ' . $request->subtitle);
    }

    public function places()
    {
        return view('admin.places', [
            'places' => Place::paginate(10)
        ]);
    }

    public function newPlace(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'city' => 'required',
            'postal_code' => 'required|integer',
            'street_name' => 'required',
            'street_number' => 'required|integer',
        ]);

        Place::create(Place::simpleDataArray($request));

        return redirect()->back()->with('message', 'Utworzono nowe miejsce spotkań.');
    }
}