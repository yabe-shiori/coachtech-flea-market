<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationMailFormRequest extends FormRequest
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
            'subject' => ['required', 'string',  'max:255'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名を入力してください',
            'subject.string' => '件名は文字列で入力してください',
            'subject.max' => '件名は255文字以内で入力してください',
            'content.required' => '本文を入力してください',
            'content.string' => '本文は文字列で入力してください',
            'content.max' => '本文は1000文字以内で入力してください',
        ];
    }
}
