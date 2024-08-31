<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['customer', 'country'];

    public function setAddress1Attribute($value): void
    {
        $this->attributes['address1'] = $value ? ucwords($value) : null;
    }

    public function setAddress2Attribute($value): void
    {
        $this->attributes['address2'] = $value ? ucwords($value) : null;
    }

    public function setCityAttribute($value): void
    {
        $this->attributes['city'] = $value ? ucwords($value) : null;
    }

    public function setStateAttribute($value): void
    {
        $this->attributes['state'] = $value ? ucwords($value) : null;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    // protected $appends = ['full_address'];

    // public function getFullAddressAttribute()
    // {
    //     return $this->address1 . ', ' . $this->address2 . ', ' . $this->city . ', ' . $this->state . ', ' . $this->pincode  . ', ' . $this->country->name;
    // }
}
