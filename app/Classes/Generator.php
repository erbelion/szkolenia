<?php

namespace App\Classes;

class Generator {
    public static function duplicateEdition($editionID, $count){
        for($i = 0; $i < $count; $i++){
            $newUser = \App\Models\Edition::find($editionID)->replicate();
            $newUser->price = rand(10,100);
            $newUser->push();
        }
    }

    public static function generatePayments($userID){
        $user = \App\Models\User::find($userID);

        \App\Models\Edition::all()->each(function($edition) use ($user){
            \App\Http\Services\EditionService::buyAccess($edition->id, $user);
        });
    }
}
