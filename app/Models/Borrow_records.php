<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow_records extends Model
{
    use HasFactory;

    /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // ID of the user who borrowed the book
        'book_id', // ID of the book borrowed
        'borrowed_at', // Date and time when the book was borrowed
        'due_date', // Due date for returning the book
        'returned_at', // Date and time when the book was returned (if returned)
    ];

    /*
     * Define the relationship between Borrow_records and Book models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book() 
    {
        return $this->belongsTo(Book::class); // A borrow record belongs to a specific book
    }

    /*
     * Define the relationship between Borrow_records and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo(User::class); // A borrow record belongs to a specific user
    }
}