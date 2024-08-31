<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function setNameAttribute(?string $value)
    {
        $this->attributes['name'] = $value ? ucwords($value) : null;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function generateReference(): string
    {
        return sprintf(
            'NEPL/%s/Q-%s/%s-%s/%s',
            strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $this->name), 0, 4)),
            date('md'),
            date('Y'),
            date('y') + 1,
            date('His')
        );
    }
}
