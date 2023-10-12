<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitations extends Model
{

    protected $fillable = [
        'from_user',
        'to_user',
        'startup_id',
    ];
    use HasFactory;
}
