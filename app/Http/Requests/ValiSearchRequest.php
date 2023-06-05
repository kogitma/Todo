<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date1' => 'nullable|date_format:Y/m/d',
            'start_date2' => 'nullable|date_format:Y/m/d',
            'end_date1' => 'nullable|date_format:Y/m/d',
            'end_date2' => 'nullable|date_format:Y/m/d',
        ];
    }

    public function messages()
    {
        return [
            'date_format' => '"年/月/日"形式で入力してください。',
        ];
    }
}