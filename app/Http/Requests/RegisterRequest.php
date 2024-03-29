<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'max:191'],
            'invitation_code' => ['nullable', 'string', 'max:8', 'exists:users,invitation_code'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスを正しく入力してください',
            'email.unique' => 'そのメールアドレスは既に登録されています',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.max' => 'メールアドレスは191文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードを文字列で入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.max' => 'パスワードは191文字以内で入力してください',
            'invitation_code.string' => '招待コードを文字列で入力してください',
            'invitation_code.max' => '招待コードは8文字以内で入力してください',
            'invitation_code.exists' => 'その招待コードは存在しません',
        ];
    }
}
