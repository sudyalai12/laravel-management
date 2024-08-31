<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceBasis extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public static $price_bases = [
        ['description' => "Ex-Works Neuvin Electronics Private Limited New Delhi – 110045"],
        ['description' => "Ex-Works AimTTi Instruments India Pvt. Ltd. New Delhi – 110045"],
    ];
}
