<?php

namespace App\Services;

use App\Models\Book; 
use Illuminate\Http\Request; 

class BookService
{
    /*
     * Create a new book.
     *
     * @param array $data The data for the new book.
     * @return Book The newly created book object.
     */
    public function createBook(array $data)
    {
        return Book::create($data); 
    }

    /*
     * Update an existing book.
     *
     * @param Book $Book The book object to update.
     * @param array $data The data to update the book with.
     * @return Book The updated book object.
     */
    public function updateBook(Book $Book, array $data)
    {
        $Book->update($data); 
        return $Book; 
    }

    /*
     * Delete a book.
     *
     * @param Book $Book The book object to delete.
     * @return void
     */
    public function deleteBook(Book $Book)
    {
        $Book->delete(); 
    }
}