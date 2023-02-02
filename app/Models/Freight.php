<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    // use HasFactory;

    protected $fillable = [
        'from_postcode',
        'to_postcode',
        'from_weight',
        'to_weight',
        'cost'
    ];

}
