<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['address', 'department', 'tax'];

    // Make all contact name first letter in capital letter
    public function setNameAttribute(?string $value)
    {
        $this->attributes['name'] = $value ? ucwords($value) : null;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
