<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    // sets up the albums belongs to artist relationship
    public function artist() 
    {   
        // albums.artist_id is the FK column
        return $this->belongsTo(Artist::class);
    }
    // album belongs to user?
    public function user() 
    {   
        // albums.artist_id is the FK column
        return $this->belongsTo(User::class);
    }
}
