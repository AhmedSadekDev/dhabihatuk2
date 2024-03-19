<?php

namespace App\Http\Requests\Suitable;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
        return [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'image' => 'required|file',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'time' => 'required|string',
            'date' => 'required|date'
        ];
    }
}
