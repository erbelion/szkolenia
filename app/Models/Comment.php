<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =
    [
        'meeting_id',
        'user_id',
        'message'

    ];
    public static function simpleDataArray($data)
    {
        return
        [
            'meeting_id'=> $data->meeting_id,
            'user_id'=>$data->user_id,
            'message'=>$data->message

        ];

    }
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
