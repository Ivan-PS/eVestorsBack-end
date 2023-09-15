<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{

    protected $fillable = [
        'name',
        'description',
        'date'
    ];
    use HasFactory;
}
