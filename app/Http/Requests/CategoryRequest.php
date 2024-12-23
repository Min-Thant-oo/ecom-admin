<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'  => 'required | unique:categories,name',
            'slug'  => 'required | unique:categories,slug'
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required | unique:categories,name,' . $this->category->id;
            $rules['slug'] = 'required | unique:categories,slug,' . $this->category->id;
        }

        return $rules;
    }
}
