<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use App\Http\Services\EditionService;

class EditionController extends Controller
{
    public function index($id)
    {
        $edition = Edition::with('course')->findOrFail($id);
        $edition->isUserStudent = $edition->isUserStudent();
        $edition->students = $edition->getAllStudentsData();

        return view('singles.edition', [
            'edition' => $edition,
        ]);
    }

    public function buy($id)
    {
        $error = EditionService::buyAccess($id);

        if($error == null)
            return redirect()->back()->with('message', 'Dostęp zakupiony');
        else
            return redirect()->back()->with('errorMessage', $error);
    }
}
