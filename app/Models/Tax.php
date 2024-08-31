<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxes';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public static $taxes = [
        ['type' => 'IGST'],
        ['type' => 'GST'],
        ['type' => 'SaleTax'],
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
