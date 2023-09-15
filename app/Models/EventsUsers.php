<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsUsers extends Model
{

    protected $fillable = [
        'event_id',
        'user_id',
    ];
    use HasFactory;
}
