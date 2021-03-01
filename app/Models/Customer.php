<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // get at the beginning  and attribute at the end - laravel created full_name attribute
    // Accessors, computed attribute in laravel
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
