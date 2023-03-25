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
        'lt_id',
        'branch',
        'batch',
        'course'
    ];
}
