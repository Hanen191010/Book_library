<?php

namespace App\Http\Controllers;


use App\Models\Book;
use Illuminate\Http\Request;
// use App\Http\Requests\BookFormRequest;
use App\Services\BookService;

class BookController extends Controller
{
    protected $BookService; 

    
    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService; 
    }
    public function index(Request $request)
    {
        $Books = Book::all();
        return response()->json($Books, 200); 
    }

    
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
        ]);

        
        $Book = $this->BookService->createBook($validatedData); 

        return response()->json($Book, 201); 
    }

    /**
     * Display the specified resource 
     */
    public function show(Book $Book)
    {
        $Book = $Book->load('ratings'); 
        return response()->json($Book, 200); 
    }


    public function update(Request $request, Book $Book)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'date', 
        ]);

        
        $updated_Book = $this->BookService->updateBook($Book, $validatedData); 
        return response()->json($updated_Book, 200); 
    }

    
    public function destroy(Book $Book)
    {
        
        $Book = $this->BookService->deleteBook($Book); 
        
        return response()->json(null, 204);}
    
    }