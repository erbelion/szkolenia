<?php

namespace App\Models;

use App\Models\Edition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function editions(){
        return $this->belongsToMany(Edition::class, 'id', 'course_id');
    }
}
