<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edition extends Model
{
    protected $fillable = [
        'subtitle',
        'description',
        'price',
        'edition_no',
        'users_limit',
        'users_count',
        'start_date',
        'end_date',
        'course_id',
    ];

    public static function simpleDataArray($data, $newEditionNo){
        return [
            'subtitle' => $data->subtitle,
            'description' => $data->description,
            'price' => $data->price,
            'users_limit' => $data->users_limit,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
            'edition_no' => $newEditionNo
        ];
    }

    public function meetings()
    {
        return $this->hasOne(Meeting::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
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
        $user = auth()->user();
        if($user)
            return $this->students()->where('user_id', $user->id)->exists();
        
        return false;
    }

    public static function getAllEditions(){
        return DB::table('editions')
        ->join('courses', 'courses.id', '=', 'editions.course_id')
        ->select('editions.id', 'courses.title', 'courses.organiser_name', 'courses.organiser_url', 'courses.description as main_description', 'editions.subtitle', 'editions.description', 'editions.price', 'editions.edition_no', 'editions.users_count', 'editions.users_limit', 'editions.start_date', 'editions.end_date')
        ->get();
    }
}
