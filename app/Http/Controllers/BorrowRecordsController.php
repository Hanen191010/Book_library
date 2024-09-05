<?php

namespace App\Http\Controllers;

use App\Models\Borrow_records;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BorrowService;

class BorrowRecordsController extends Controller
{
    protected $BorrowService; 

    // Dependency Injection of BorrowService
    public function __construct(BorrowService $BorrowService)
    {
        $this->BorrowService = $BorrowService; 
    }

    /**
     * Filter books based on various criteria.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Collection
     */
    public function filter(Request $request)
    {
        $query = Book::query(); // Start a new query builder

        // Filter by author
        if ($request->has('author')) {
            $query->where('author', $request->author);
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter for available books (not borrowed or returned)
        if ($request->has('available')) {
            $query->whereDoesntHave('borrow_records', function ($q) {
                $q->whereNull('returned_at'); // Check if returned_at is null
            });
        }

        // Return the filtered books as a collection
        return $query->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all borrow records
        $Borrows = Borrow_records::all();
        // Return the borrow records as JSON with status code 200 (OK)
        return response()->json($Borrows, 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id' // Ensure book_id exists in the books table
        ]);

        // Create a new borrow record using the BorrowService
        $Borrow = $this->BorrowService->createBorrow($validatedData); 

        // Return the newly created borrow record as JSON with status code 201 (Created)
        return response()->json($Borrow, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Borrow_records $Borrow_records
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow_records $Borrow_records)
    {
        // Return the borrow record as JSON with status code 200 (OK)
        return response()->json($Borrow_records, 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(string $id)
    {
        // Update the borrow record using the BorrowService
        $updated_Borrow = $this->BorrowService->updateBorrow($id); 
        // Return the updated borrow record as JSON with status code 200 (OK)
        return response()->json($updated_Borrow, 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Borrow_records $Borrow_records
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow_records $Borrow_records)
    {
        // Delete the borrow record using the BorrowService
        $Borrow = $this->BorrowService->deleteBorrow($Borrow_records); 

        // Return an empty response with status code 204 (No Content) 
        return response()->json(null, 204);
    }

}