<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    

    /**
     * Get the user record associated with the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the description for the blog post.
     */
    public function descripcion()
    {
        return $this->hasMany(Rol::class);
    }


}