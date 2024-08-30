<?php

namespace App\Http\Controllers;

use App\Models\Borrow_records;
use Illuminate\Http\Request;
use App\Services\BorrowService;

class BorrowRecordsController extends Controller
{
    protected $BorrowService; 

    
    public function __construct(BorrowService $BorrowService)
    {
        $this->BorrowService = $BorrowService; 
    }
    public function index(Request $request)
    {
        $Borrows = Borrow_records::all();
        return response()->json($Borrows, 200); 
    }

    
    public function store(Request $request)
    {   
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'name'=>'max=255'
        ]);

        // return var_dump($request->book_id);
        $Borrow = $this->BorrowService->createBorrow($validatedData); 

        return response()->json($Borrow, 201); 
    }

    /**
     * Display the specified resource 
     */
    public function show(Borrow_records $Borrow_records)
    {
        return response()->json($Borrow_records, 200); 
    }


    public function update(string $id)
    {
        $updated_Borrow = $this->BorrowService->updateBorrow($id); 
        return response()->json($updated_Borrow, 200); 
    }

    
    public function destroy(Borrow_records $Borrow_records)
    {
        
        $Borrow = $this->BorrowService->deleteBorrow($Borrow_records); 
        
        return response()->json(null, 204);}
    
    }