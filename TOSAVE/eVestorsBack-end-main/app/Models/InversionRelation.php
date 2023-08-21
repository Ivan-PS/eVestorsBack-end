<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InversionRelation extends Model
{
    protected $fillable = [
        'owner_id',
        'inversor_id',
        'percent'
    ];
}
