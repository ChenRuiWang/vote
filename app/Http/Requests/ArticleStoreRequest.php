<?php

namespace App\Http\Requests;


class ArticleStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255|min:6',
            'url' => 'required|string|url'
        ];
    }
}
