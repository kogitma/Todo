<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|max:32', 
            'u_unique_id' => 'required|regex:/^[0-9]{8}$/'
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目となります。',
            'password.max' => '32文字以内で入力してください。',
            'u_unique_id.regex' => '8文字以上半角数値で入力してください。',
        ];
    }
}