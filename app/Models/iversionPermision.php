<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IversionPermision extends Model
{
    protected $fillable = [
        'user_id',
        'startup_id',
        'percent',
    ];
}
