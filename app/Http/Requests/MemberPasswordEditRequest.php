<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberPasswordEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'パスワードは必須項目です。',
            'password.min:8' => '8文字以上で入力してください。',
            'password_confirmation.required' => 'パスワード確認は必須項目です。',
            'password_confirmation.min:8' => '8文字以上で入力してください。'
        ];
    }
}
