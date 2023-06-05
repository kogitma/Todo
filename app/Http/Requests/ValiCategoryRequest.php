<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255', 
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目となります。',
            'password.max' => '255文字以内で入力してください。',
        ];
    }
}