<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'author', 
        'published_at', 
        'description', 
    ];
    public function ratings()
    {
        return $this->hasMany(Rating::class); 
    }
    public function borrow_records()
    {
        return $this->hasMany(Borrow_records::class); 
    }
}
