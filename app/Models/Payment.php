<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'edition_id',
        'amount',
        'is_paid'
    ];

    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }
}
