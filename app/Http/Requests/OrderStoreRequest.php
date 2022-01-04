<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest {
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
            'name'         => 'required|max:255|string',
            'phone'        => 'required|max:11|min:11',
            'division'     => 'required|max:255|string',
            'district'     => 'required|max:255|string',
            'address'      => 'required|max:5000|string',
            'delivery_fee' => 'required|max:255',
            'subtotal'     => 'required',
        ];
    }
}
