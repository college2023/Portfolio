<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'keyword' => 'required|string|max:100', //字数制限。バリエーション。データベースのエラー。
        ];
    }

    public function messages()
    {
        return [
            'keyword.required' => '入力は必須です。',
            'keyword.string' => '文字列を入力してください。',
            'keyword.max' => '最大100文字です。',
        ];
    }
}
