<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'title'         => 'required',
            'description'   => 'required',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|numeric',
            'image'         => 'required|image ',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['title']         = 'required';
            $rules['description']   = 'required';
            $rules['category_id']   = 'required|exists:categories,id';
            $rules['price']         = 'required|numeric';
            $rules['image']         = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }
}
