<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // ID of the user who gave the rating
        'book_id', // ID of the book being rated
        'rating', // Numerical rating (e.g., 1-5 stars)
        'review', // Textual review (optional)
    ];

    /*
     * Define the relationship between Rating and Book models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book() 
    {
        return $this->belongsTo(Book::class); // A rating belongs to a specific book
    }

    /*
     * Define the relationship between Rating and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo(User::class); // A rating belongs to a specific user
    }
}