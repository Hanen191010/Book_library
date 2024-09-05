<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // يمكنك تحديد شروط معينة هنا لمعرفة ما إذا كان المستخدم مخولًا 
        // لإجراء هذا الطلب. على سبيل المثال، يمكنك السماح فقط للمستخدمين 
        // الذين لديهم دور معين بإجراء هذا الطلب.
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255', // عنوان الكتاب مطلوب، سلسلة نصية، بحد أقصى 255 حرف
            'author' => 'required|string|min:3', // مؤلف الكتاب مطلوب، سلسلة نصية، بحد أدنى 3 حروف
            'description' => 'nullable|string', // الوصف اختياري، سلسلة نصية 
            'published_at' => 'nullable|date', // تاريخ النشر اختياري، تاريخ صحيح
            'category' => 'required|string|max:255'// تصنيف الكتاب مطلوب، سلسلة نصية، بحد أقصى 255 حرف
        ];
    }

    /**
     * تخصيص أسماء الحقول عند عرض رسائل الخطأ
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'اسم الكتاب',
            'author' => 'المؤلف',
            'description' => 'الوصف',
            'published_at' => 'تاريخ النشر',
            'category' => 'تصنيف الكتاب '
        ];
    }

    /**
     * تخصيص رسائل التحقق
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'اسم الكتاب مطلوب',
            'author.required' => 'المؤلف مطلوب',
            'author.min' => 'اسم المؤلف يجب أن يحتوي على 3 حروف على الأقل',
            'published_at.date' => 'تاريخ النشر غير صحيح',
            'category.required' => 'تصنيف الكتاب مطلوب'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        // يمكنك هنا معالجة رسائل الخطأ. 
        // على سبيل المثال، يمكنك إرجاع رسالة مخصصة 
        // إلى المستخدم أو تسجيل رسالة خطأ في سجلات 
        // التطبيق.

        // مثال: 
        $response = [
            'success' => false,
            'message' => 'خطأ في البيانات المرسلة.',
            'errors' => $validator->errors()->all()
        ];

        // يمكنك إرجاع الرد باستخدام Response::json()
        return response()->json($response, 422); // 422: Unprocessable Entity
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        // يمكنك هنا تنفيذ عمليات إضافية بعد 
        // نجاح عملية التحقق. 
        // على سبيل المثال، يمكنك تسجيل سجل في قاعدة البيانات 
        // أو إرسال تنبيه إلى المستخدم. 
    }
}