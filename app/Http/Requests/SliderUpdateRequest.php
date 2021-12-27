<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderUpdateRequest extends FormRequest {
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
            'title'       => 'max:100|nullable',
            'description' => 'max:2000|nullable',
            'image'       => 'nullable|max:600|mimes:jpg,png,jpeg',
            'precedence'  => ['required', 'integer', Rule::unique('sliders')->ignore($this->hidden_id)],
        ];
    }

    public function messages() {
        return [
            'precedence.unique'        => 'This precendence has already been used.',
        ];
    }
}
