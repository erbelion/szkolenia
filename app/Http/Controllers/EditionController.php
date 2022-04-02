<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Services\EditionService;

class EditionController extends Controller
{
    public function index($id)
    {
        $edition = Edition::with('course')->findOrFail($id);
        $meetings = Meeting::where('edition_id', $id)->orderBy('updated_at', 'asc')->paginate(10);

        return view('singles.edition', [
            'edition' => $edition,
            'meetings' => $meetings,
            'isUserStudent' => $edition->isUserStudent(),
            'students' => $edition->getAllStudentsData()
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
