<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function setNameAttribute(?string $value)
    {
        $this->attributes['name'] = $value ? ucwords($value) : null;
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
