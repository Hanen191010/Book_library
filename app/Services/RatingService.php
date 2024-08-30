<?php

namespace App\Services;

use App\Models\Rating; // Import the Rating model

class RatingService
{
    /*
     * Creates a new rating.
     *
     * @param array $data The data for the new rating.
     * @return Rating The newly created rating instance.
     */
    public function createRating(array $data)
    {
        $new_rating = new Rating();
        $new_rating->book_id = $data['book_id'];
        $new_rating->user_id = auth()->id(); // استخدام JWT للتحقق من المستخدم
        $new_rating->rating = $data['rating'];
        $new_rating->review = $data['review'];
        $new_rating->save();
        return $new_rating; // Use the Rating model's create method to create a new rating record from the provided data
    }

    /*
     * Updates an existing rating.
     *
     * @param Rating $rating The rating instance to update.
     * @param array $data The data to update the rating with.
     * @return Rating The updated rating instance.
     */
    public function updateRating(Rating $rating, array $data)
    {
        $rating->update($data); // Use the Rating model's update method to update the existing rating instance with the provided data
        return $rating; // Return the updated rating instance
    }

    /*
     * Deletes a rating.
     *
     * @param Rating $rating The rating instance to delete.
     * @return void
     */
    public function deleteRating(Rating $rating)
    {
        $rating->delete(); // Use the Rating model's delete method to delete the rating record
    }
}
