<?php

namespace App\Services;

use App\Models\Borrow_records; 
use App\Models\Book; 
use Illuminate\Http\Request; 

class BorrowService
{
    /*
     * Create a new borrow record.
     *
     * @param array $data The data for the new borrow record.
     * @return Borrow_records|Illuminate\Http\JsonResponse The newly created borrow record object or an error response.
     */
    public function createBorrow(array $data)
    {   
        // تحقق مما إذا كان الكتاب متاحًا
        $book = Book::findOrFail($data['book_id']); // ابحث عن الكتاب باستخدام `book_id` من البيانات
        if (Borrow_records::where('book_id', $book->id)->whereNull('returned_at')->exists()) {
            return response()->json(['error' => 'This book is already borrowed'], 400); // رد بخطأ إذا كان الكتاب معارًا بالفعل
        }

        // إنشاء سجل الاستعارة 
        $record = new Borrow_records();
        $record->book_id = $book->id;
        $record->user_id = auth()->id(); // استخدام JWT للتحقق من المستخدم 
        $record->borrowed_at = now(); // تاريخ ووقت الاستعارة الحالي
        $record->due_date = now()->addDays(14); // تاريخ الاستحقاق بعد 14 يومًا
        $record->save(); // حفظ سجل الاستعارة في قاعدة البيانات

        return $record; // إرجاع سجل الاستعارة الذي تم إنشاؤه
    }

    /*
     * Update an existing borrow record (mark as returned).
     *
     * @param string $id The ID of the borrow record to update.
     * @return Borrow_records The updated borrow record object.
     */
    public function updateBorrow(string $id)
    {   
        $Borrow_records = Borrow_records::find($id); // ابحث عن سجل الاستعارة باستخدام ID
        $Borrow_records->returned_at = now(); // تاريخ ووقت الإرجاع الحالي 
        $Borrow_records->save(); // حفظ التغييرات في قاعدة البيانات

        return $Borrow_records; // إرجاع سجل الاستعارة الذي تم تحديثه
    }

    /*
     * Delete a borrow record.
     *
     * @param Borrow_records $Borrow_records The borrow record object to delete.
     * @return void
     */
    public function deleteBorrow(Borrow_records $Borrow_records)
    {
        $Borrow_records->delete(); 
    }
}
