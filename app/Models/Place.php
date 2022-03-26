<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'country',
        'city',
        'postal_code',
        'street_name',
        'street_number',
        'apartment_number',
        'room'
    ];

    public static function simpleDataArray($data){
        return [
            'country' => $data->country,
            'city' => $data->city,
            'postal_code' => $data->postal_code,
            'street_name' => $data->street_name,
            'street_number' => $data->street_number,
            'apartment_number' => $data->apartment_number,
            'room' => $data->room
        ];
    }

    public function getNiceName(){
        $builder = $this->street_name . ' ' . $this->street_number;
        
        if($this->apartment_number)
            $builder .= '/' . $this->apartment_number;

        if($this->room)
            $builder .= ' (sala ' . $this->room . ')';

        $builder .= ', ' . $this->postal_code . ' ' . $this->city . ', ' . $this->country;

        return $builder;
    }
}
