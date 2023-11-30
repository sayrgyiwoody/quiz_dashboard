<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_code',
        'quiz_id',
        'host_id',
        'start_time',
        'end_time',
        'status'
    ];
}
