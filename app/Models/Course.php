<?php

namespace App\Models;

use App\Models\Edition;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'organiser_name',
        'organiser_url',
        'description',
        'editions_limit'
    ];

    public static function simpleDataArray($data){
        return [
            'title' => $data->title,
            'organiser_name' => $data->organiser_name,
            'organiser_url' => $data->organiser_url,
            'description' => $data->description,
            'editions_limit' => $data->editions_limit,
        ];
    }    

    public function edition()
    {
        return $this->hasOne(Edition::class);
    }
}
