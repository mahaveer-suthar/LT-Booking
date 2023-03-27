<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetablesource extends Model
{
    use HasFactory;
    protected $fillable=[
        'start_date',
        'end_date',
        'course',
        'is_active'
    ];
    public function timetable(){
        return $this->hasMany(Timetable::class,'timetablesources_id','id');
    }
}
