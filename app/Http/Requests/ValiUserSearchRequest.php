<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiUserSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|max:32',
            'email' => 'nullable|max:1024|email',
            'u_unique_id' => 'nullable|regex:/^[0-9]{8}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '32文字以内で入力してください。',
            'email.max' => '1024文字以内で入力してください。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'u_unique_id.regex' => '8文字以上半角数値で入力してください。',
        ];
    }
}