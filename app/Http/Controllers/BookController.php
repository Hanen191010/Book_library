<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest; // Import the BookFormRequest 
use App\Services\BookService;

class BookController extends Controller
{
    protected $BookService; 

    // Dependency Injection of BookService
    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all books
        $Books = Book::all(); 
        // Return the books as JSON with status code 200 (OK)
        return response()->json($Books, 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data using built-in validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255', // Category added
            'author' => 'required|string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
        ]);

        // Create a new book using the BookService
        $Book = $this->BookService->createBook($validatedData); 

        // Return the newly created book as JSON with status code 201 (Created)
        return response()->json($Book, 201); 
    }

    /**
     * Display the specified resource 
     *
     * @param \App\Models\Book $Book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $Book)
    {
        // Load the ratings associated with the book
        $Book = $Book->load('ratings'); 
        // Return the book with its ratings as JSON with status code 200 (OK)
        return response()->json($Book, 200); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $Book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $Book)
    {
        // Validate the request data using built-in validation
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'date', 
        ]);

        // Update the book using the BookService
        $updated_Book = $this->BookService->updateBook($Book, $validatedData); 
        // Return the updated book as JSON with status code 200 (OK)
        return response()->json($updated_Book, 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $Book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $Book)
    {
        // Delete the book using the BookService
        $Book = $this->BookService->deleteBook($Book); 

        // Return an empty response with status code 204 (No Content) 
        return response()->json(null, 204);
    }

}
