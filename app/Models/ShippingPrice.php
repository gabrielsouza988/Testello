<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{
    Crypt,
    DB
};

class ShippingPrice extends Model
{
    // use HasFactory;

    const ALLOWED_FILE_TYPE = 'csv';

    protected $fillable = [
        'customer_id',
        'from_postcode',
        'to_postcode',
        'from_weight',
        'to_weight',
        'cost'
    ];

}
