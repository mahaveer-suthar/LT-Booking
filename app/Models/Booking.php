<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'date',
        'user_id',
        'timeslots_id',
        'lt_id',
        'status'
    ];
    public function users(){
        return $this->BelongsTo(User::class,'user_id','id');
    }
}
