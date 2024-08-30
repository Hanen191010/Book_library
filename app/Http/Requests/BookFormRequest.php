<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BookFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
        ];
    }
    public function messages() {
        return [
            'title.required' => 'اسم الكتاب مطلوب',
            'author.required' => 'اسم المؤلف مطلوب',
        ];
    }
    protected function failedValidation(Validator $validator)
   {
       return response()->json(['errors' => $validator->errors()], 422);
   }
    // protected function passedValidation() {
    //     // تنفيذ عملية إضافية بعد التحقق الناجح
    // }
}
