<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRecordFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'book_id' => 'required|exists:books,id',
        'user_id' => 'required|exists:users,id',
        'borrowed_at' => 'required|date',
        'due_date' => 'required|date|after_or_equal:borrowed_at',
    ];
}
}
