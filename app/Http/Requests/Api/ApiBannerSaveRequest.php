<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ApiBannerSaveRequest extends FormRequest
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
                'description' => 'required|string|max:255',
                'btn_text' => 'required|string|max:255',
                'btn_link' => 'required|string|max:255',
        ];
    }
}
