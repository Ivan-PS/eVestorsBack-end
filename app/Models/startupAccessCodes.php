<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupAccessCodes extends Model
{
    protected $fillable = [
        'startup_id',
        'accessCode'
    ];
}
