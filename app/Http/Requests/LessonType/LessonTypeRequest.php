<?php

namespace App\Http\Requests\LessonType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonTypeRequest extends FormRequest
{
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('lesson_types', 'name')->ignore($this->lesson_type)],
            'description' => ['string'],
        ];
    }
}
