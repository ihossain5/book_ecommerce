<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'        => 'required|max:255|string',
            'description' => 'required|max:10000|string',
            'precedance'  => 'required|unique:categories,precedance',
            'photo'       => 'required|max:300|image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages() {
        return [
            'name.required'        => 'Please insert category name.',
            'description.required' => 'Please insert category description',
            'photo.required'       => 'Please upload category photo',
        ];
    }
}
