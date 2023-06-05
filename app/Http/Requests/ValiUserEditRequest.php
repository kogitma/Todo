<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValiUserEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'email' => 'required|max:1024|email',
            'password' => 'max:32', 
            'u_unique_id' => ['required', 'regex:/^[0-9]{8}$/', Rule::unique('users')->ignore($this->id)]          
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目となります。',
            'name.max' => '32文字以内で入力してください。',
            'email.max' => '1024文字以内で入力してください。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'password.max' => '32文字以内で入力してください。',
            'u_unique_id.regex' => '8文字以上半角数値で入力してください。',
            'u_unique_id.unique' => 'そのユーザーIDは既に存在しています。',
        ];
    }
}