<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
            'image' => ['required', 'array'],
            'image.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['exists:brands,id'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999.99'],
            'condition' => ['required', Rule::in([
                '新品、未使用',
                '未使用に近い',
                '目立った傷や汚れなし',
                'やや傷や汚れあり',
                '傷や汚れあり',
                '全体的に状態が悪い',
            ])],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像を選択してください。',
            'image.*.required' => '画像ファイルを選択してください。',
            'image.*.image' => '画像ファイルを選択してください。',
            'image.*.mimes' => '画像ファイルの形式はjpeg、png、jpg、gif、svgのいずれかを選択してください。',
            'image.*.max' => '画像ファイルのサイズは2MB以下にしてください。',
            'name.required' => '商品名を入力してください。',
            'name.string' => '商品名は文字列で入力してください。',
            'name.max' => '商品名は255文字以内で入力してください。',
            'category_id.required' => 'カテゴリーを選択してください。',
            'category_id.exists' => '選択されたカテゴリーは無効です。',
            'brand_id.exists' => '選択されたブランドは無効です。',
            'price.required' => '価格を入力してください。',
            'price.numeric' => '価格は数値で入力してください。',
            'price.min' => '価格は0円以上で入力してください。',
            'price.max' => '価格は9999999.99円以下で入力してください。',
            'condition.required' => '商品の状態を選択してください。',
            'condition.in' => '選択された商品の状態は無効です。',
            'description.string' => '商品説明は文字列で入力してください。',
            'description.max' => '商品説明は1000文字以内で入力してください。',
        ];
    }
}
