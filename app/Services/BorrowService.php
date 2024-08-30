<?php

namespace App\Services;

use App\Models\Borrow_records; 
use App\Models\Book; 
use Illuminate\Http\Request; 

class BorrowService
{
    
    public function createBorrow(array $data)
    {   
        // تحقق مما إذا كان الكتاب متاحًا
        $book = Book::findOrFail($data['book_id']);
        if (Borrow_records::where('book_id', $book->id)->whereNull('returned_at')->exists()) {
            return response()->json(['error' => 'This book is already borrowed'], 400);
        }

        // إنشاء سجل الاستعارة 
        $record = new Borrow_records();
        $record->book_id = $book->id;
        $record->user_id = auth()->id(); // استخدام JWT للتحقق من المستخدم
        $record->borrowed_at = now();
        $record->due_date = now()->addDays(14);
        $record->save();

        return $record;
    }

    
    public function updateBorrow(string $id)
    {   
        // return var_dump($Borrow_records['returned_at']);
        // اعادة كتاب 
        $Borrow_records = Borrow_records::find($id);
        $Borrow_records->returned_at = now();
        $Borrow_records->save();

        return  $Borrow_records;
    }

    
    public function deleteBorrow(Borrow_records $Borrow_records)
    {
        $Borrow_records->delete(); 
    }
}
