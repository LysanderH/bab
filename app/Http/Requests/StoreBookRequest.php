<?php

namespace App\Http\Requests;

use App\Rules\ISBN;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ISBN' => ['required', 'min:3', 'max:256', new ISBN],
            'title' => 'required|min:3|max:256',
            'author' => 'required|min:3|max:256',
            'cover' => 'required|image|mimes:jpeg,png,jpg',
            'stock' => 'required|min:0|max:10000|numeric',
            'price' => 'required|min:0|max:10000|numeric',
            'category' => 'required',
            'bac' => 'required',
            'excerpt' => 'required',
            'bac' => 'required',
        ];
    }
}
