<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($id)
    {
        return view('singles.course', [
            'course' => Course::find($id)
        ]);
    }
}
