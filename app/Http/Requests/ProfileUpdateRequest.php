<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'introduction' => ['string', 'max:1000'],
            'postal_code' => ['required', 'string', 'max:8'],
            'address' => ['required', 'string', 'max:255'],
            'building_name' => ['string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力して下さい',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は255文字以内で入力して下さい',
            'introduction.string' => '自己紹介は文字列で入力してください',
            'introduction.max' => '自己紹介は1000文字以内で入力して下さい',
            'postal_code.required' => '郵便番号を入力して下さい',
            'postal_code.string' => '郵便番号は文字列で入力してください',
            'postal_code.max' => '郵便番号は8文字以内で入力して下さい',
            'address.required' => '住所を入力して下さい',
            'address.string' => '住所は文字列で入力してください',
            'address.max' => '住所は255文字以内で入力して下さい',
            'building_name.string' => '建物名は文字列で入力してください',
            'building_name.max' => '建物名は255文字以内で入力して下さい',
        ];
    }
}
