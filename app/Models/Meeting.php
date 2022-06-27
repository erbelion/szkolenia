<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'place_id',
        'edition_id',
        'start_date',
        'end_date',
    ];

    public static function simpleDataArray($data){
        return [
            'title' => $data->title,
            'description' => $data->description,
            'place_id' => $data->place_id,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date
        ];
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function students()
    {
        return $this->hasOne(Student::class);
    }

    public function getAllStudentsData()
    {
        return DB::table('students')
        ->where('students.edition_id', $this->id)
        ->join('users', 'users.id', '=', 'students.user_id')
        ->select('users.name', 'users.email')
        ->get();
    }

    public function isUserStudent()
    {
        return $this->students()->where('user_id', auth()->user()->id)->exists();
    }
}
