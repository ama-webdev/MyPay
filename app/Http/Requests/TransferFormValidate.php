<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferFormValidate extends FormRequest
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
            'to_phone' => 'required|min:11|max:11',
        ];
    }

    public function messages()
    {
        return [
            'to_phone.required' => 'Please fill the phone number to transfer.',
            'to_phone.min' => 'Phone number must be at least 11 numbers.',
            'to_phone.max' => 'Phone number must be at most 11 numbers.',
        ];
    }
}
