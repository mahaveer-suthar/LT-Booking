<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $fillable=[
        'timetablesources_id',
        'day',
        'timeslots_id',
        'start_time',
        'end_time',
        'teacher_name',
        'designation',
        'lt_id',
        'branch',
        'batch',
        'course'
    ];
}
