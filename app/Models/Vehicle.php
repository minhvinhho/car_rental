<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'image',
        'name',
        'type',
        'no_plate',
        'no_of_seats',
        'condition',
        'ac_status',
        'owner_name',
        'hiring_cost',
        'status',
    ];
}
