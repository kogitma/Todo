<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiTodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:32',
            'content' => 'required|max:1024',
            'start_date' => 'required|date_format:Y/m/d',
            'end_date' => 'required|date_format:Y/m/d',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目となります。',
            'title.max' => '32文字以内で入力してください。',
            'content.max' => '1024文字以内で入力してください。',
            'date_format' => '"年/月/日"形式で入力してください。',
        ];
    }
}