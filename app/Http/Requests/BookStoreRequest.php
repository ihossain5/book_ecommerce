<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest {
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
            'title'               => 'required|max:255|string',
            'slug'                => 'required|max:255|string',
            'isbn'                => 'required|max:255|string',
            'publication_id'      => 'required',
            'short_description'   => 'required|max:255|string',
            'long_description'    => 'required|max:1000|string',
            'regular_price'       => 'required',
            'discount_percentage' => 'required',
            'cover_photo'         => 'required|mimes:png,jpg,jpeg|max:300',
            'back_photo'          => 'required|mimes:png,jpg,jpeg|max:300',
            'preview_book'        => 'required|mimes:pdf|max:600',
            "category"            => "required|array",
            "category.*"          => "required|distinct",
            "author"              => "required|array",
            "author.*"            => "required|distinct",
            // "attribute"           => "required|array",
            // "attribute.*"         => "required|distinct",
        ];
    }
    public function messages() {
        return [
            'title.required'               => 'Please insert book title.',
            'isbn.required'                => 'Please insert book isbn number',
            'publication_id.required'      => 'Please select publication',
            'short_description.required'   => 'Please insert book short description',
            'long_description.required'    => 'Please insert book long description',
            'regular_price.required'       => 'Please insert book regular price',
            'discount_percentage.required' => 'Please insert book discount percentage',
            'cover_photo.required'         => 'Please upload book cover photo',
            'back_photo.required'          => 'Please upload book back side photo',
            'preview_book.required'        => 'Please upload pdf for preview book',
            'short_description.required'   => 'Please select publication',
        ];
    }
}
