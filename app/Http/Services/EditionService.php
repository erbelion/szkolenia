<?php

namespace App\Http\Services;

use App\Models\Edition;


class EditionService
{
    public static function buyAccess($id){
        $user = auth()->user();

        if($user->student()->where('edition_id', $id)->exists())
            return 'Kupiono już dostęp do tej edycji';

        $edition = Edition::findOrFail($id);

        if($edition->users_count >= $edition->users_limit)
            return 'Edycja jest pełna';

        //w innym wypadku da się kupić dostęp
        $user->payment()->create([
            'edition_id' => $id,
            'amount' => $edition->price
        ]);

        $edition->users_count++;
        $edition->save();

        //Zaślepka; to powinien zatwierdzić webhook ze strony przyjmującej płatności
            $user->payment()->where('edition_id', $id)->update([
                'is_paid' => true
            ]);

            $user->student()->create([
                'edition_id' => $id
            ]);
        //Zaślepka; błąd powinien zostać zatwierdzony przez webhook ze strony przyjmującej płatności
            // $edition->users_count--;
            // $edition->save();
        //koniec zaślepki

        return null;
    }
}