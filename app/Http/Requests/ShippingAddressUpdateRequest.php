<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressUpdateRequest extends FormRequest
{

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
            'postal_code' =>  ['required', 'string', 'max:8', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building_name' => ['string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'postal_code.required' => '郵便番号を入力して下さい',
            'postal_code.string' => '郵便番号は文字列で入力してください',
            'postal_code.max' => '郵便番号は8文字以内で入力して下さい',
            'postal_code.regex' => '郵便番号の形式が正しくありません（例: 123-4567）',
            'address.required' => '住所を入力して下さい',
            'address.string' => '住所は文字列で入力してください',
            'address.max' => '住所は255文字以内で入力して下さい',
            'building_name.string' => '建物名は文字列で入力してください',
            'building_name.max' => '建物名は255文字以内で入力して下さい',
        ];
    }
}
