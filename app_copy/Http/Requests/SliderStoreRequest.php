<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'title'       => 'max:100|nullable',
            'description' => 'max:2000|nullable',
            'image'       => 'required|max:600|mimes:jpg,png,jpeg',
            'precedence'  => 'integer|required|unique:sliders',
        ];
    }
}
