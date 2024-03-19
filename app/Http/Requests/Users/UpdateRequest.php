<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'nullable|unique:users,email,' . $this->user_id,
            'phone' => 'required|unique:users,phone,' . $this->user_id,
            'password' => 'nullable',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'image' => 'nullable|file|mimes:png,jpg,jpeg',
            'twitter' => 'nullable'
        ];
    }
}
