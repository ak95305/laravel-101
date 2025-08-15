<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function getFirstNameAttribute()
    {
        return "Hello";
    }

    public function setLastNameAttribute()
    {
        $this->attributes["last_name"] = "Hello";
    }
}
