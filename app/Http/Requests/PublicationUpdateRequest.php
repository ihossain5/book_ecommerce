<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationUpdateRequest extends FormRequest {
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
            'precedance'  => 'required',
            'photo'       => 'max:600|image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages() {
        return [
            'name.required'        => 'Please insert publication name.',
            'description.required' => 'Please insert publication description.',
        ];
    }
}
