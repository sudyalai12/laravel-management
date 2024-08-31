<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public static $deliveries = [
        ['description' => '4 – 6 weeks, effective from date of receipt of confirmed PO/Payment/LC.'],
        ['description' => '2 – 4 weeks, effective from date of receipt of confirmed PO/Payment/LC.'],
        ['description' => '6 – 8 weeks, effective from date of receipt of confirmed PO/Payment/LC.'],
    ];
}
