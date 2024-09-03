<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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

                'firstname' => 'required|max:255|string',
                'lastname' => 'required|max:255|string',
                'email' => 'required|max:255|string',
                'city' => 'required|max:255|string',
                'postal_code' => 'required|max:255|string',
                'address' => 'required|max:255|string',
                'phone' => 'required|max:255|string',
                'total' => 'required|max:255|string',

        ];
    }
}
