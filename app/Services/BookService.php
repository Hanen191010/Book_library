<?php

namespace App\Services;

use App\Models\Book; 
use Illuminate\Http\Request; 

class BookService
{
    
    public function createBook(array $data)
    {
        return Book::create($data); 
    }

    
    public function updateBook(Book $Book, array $data)
    {
        $Book->update($data); 
        return $Book; 
    }

    
    public function deleteBook(Book $Book)
    {
        $Book->delete(); 
    }
}
