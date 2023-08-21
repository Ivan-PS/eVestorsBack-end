<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'startup_id'
    ];
}
