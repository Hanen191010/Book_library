<?php

namespace App\Http\Controllers;

use App\Services\RatingService; // Import the RatingService interface
use App\Models\Rating; // Import the Rating model
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    protected $ratingService; // Declare a property to store the RatingService instance

    // Inject the RatingService dependency into the constructor
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService; // Initialize the RatingService property
    }

    // Create a new rating
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'required|integer|exists:Books,id', // Book ID is required, must be an integer, and must exist in the Books table
            'rating' => 'required|integer|between:1,5', // Rating is required, must be an integer, and must be between 1 and 5
            'review' => 'nullable|string|max:255', // Review is optional, can be a string, and max 255 characters
        ]);

        // Create the rating using the RatingService
        $rating = $this->ratingService->createRating($validatedData); // Call the createRating method from the service

        // Return a JSON response with the created rating and a 201 Created status code
        return response()->json($rating, 201); 
    }

    // Update an existing rating
    public function update(Request $request, Rating $rating)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'integer|exists:Books,id', // Book ID is required, must be an integer, and must exist in the Books table
            'rating' => 'integer|between:1,5', // Rating is required, must be an integer, and must be between 1 and 5
            'review' => 'nullable|string|max:255', // Review is optional, can be a string, and max 255 characters
        ]);

        // Update the rating using the RatingService
        $updatedRating = $this->ratingService->updateRating($rating, $validatedData); // Call the updateRating method from the service

        // Return a JSON response with the updated rating
        return response()->json($updatedRating); 
    }

    // Delete a rating
    public function destroy(Rating $rating)
    {
        // Delete the rating using the RatingService
        $this->ratingService->deleteRating($rating); // Call the deleteRating method from the service

        // Return a 204 No Content status code as there is no content to return
        return response()->json(null, 204); 
    }
}
