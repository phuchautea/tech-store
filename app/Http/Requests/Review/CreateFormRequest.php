<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required|min:1|max:5'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'content.required' => 'Vui lòng nhập nội dung',
            'user_id.required' => 'User không hợp lệ',
            'product_id.required' => 'Sản phẩm không hợp lệ',
            'rating.required' => 'Vui lòng chọn rating'
        ];
    }
}
