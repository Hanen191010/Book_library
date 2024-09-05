<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', // عنوان الكتاب
        'category', // فئة الكتاب
        'author', // مؤلف الكتاب
        'published_at', // تاريخ نشر الكتاب
        'description', // وصف الكتاب
    ];

    /*
     * Define the relationship between Book and Rating models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class); // كتاب واحد يمكن أن يكون لديه العديد من التقييمات
    }

    /*
     * Define the relationship between Book and Borrow_records models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrow_records()
    {
        return $this->hasMany(Borrow_records::class); // كتاب واحد يمكن أن يكون لديه العديد من سجلات الاستعارة

    }

    /*
     * Calculate the average rating for the book.
     *
     * @return float|null The average rating, or null if there are no ratings.
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating'); // حساب متوسط التقييمات
    }
}
