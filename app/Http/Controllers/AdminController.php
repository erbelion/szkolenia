<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Course;
use App\Models\Edition;
use App\Models\Meeting;
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
            'course' => Course::find($id)
        ]);
    }

    public function newEdition(Request $request, $id)
    {
        $course = Course::find($id);

        $request->validate([
            'subtitle' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:1',
            'users_limit' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $newEditionNo = Edition::where('course_id', $id)->count() + 1;

        if($newEditionNo > $course->editions_limit)
            return redirect()->back()->with('errorMessage', 'Nie utworzono edycji - przekroczono limit');

        $course->edition()->create(Edition::simpleDataArray($request, $newEditionNo));

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

    public function meetings($id)
    {
        $meetings = Meeting::where('edition_id', $id)->paginate(10);

        return view('admin.meetings', [
            'meetings' => $meetings,
            'edition' => Edition::find($id),
            'places' => Place::all()
        ]);
    }

    public function newMeeting(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'place_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Edition::find($id)->meetings()->create(Meeting::simpleDataArray($request));

        return redirect()->route('admin.meetings', $id)->with('message', 'Utworzono spotkanie.');
    }
}