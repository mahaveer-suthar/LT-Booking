<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lt_rooms extends Model
{
    use HasFactory;
    protected $fillable=['room_name','status'];
}
