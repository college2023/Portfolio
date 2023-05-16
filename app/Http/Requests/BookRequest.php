<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'review.address' => 'required|string|max:100', //字数制限。バリエーション。データベースのエラー。
            'review.body' => 'required|string|max:400', //字数制限
        ];
    }

    public function messages()
    {
        return [
            //場所、住所
            'review.address.required' => '入力は必須です。',
            'review.address.string' => '文字列で入力してください。',
            'review.address.max' => '最大100文字。',
            //くちこみ内容
            'review.body.required' => '入力は必須です。', //字数制限
            'review.body.string' => '文字列で入力してください。', //字数制限
            'review.body.max' => '最大100文字。', //字数制限
        ];
    }
}
