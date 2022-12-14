<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusRequest extends FormRequest
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
            'number_plate' => 'required|unique:buses',
            'serial_number' => 'required|unique:buses',
            'distributor' => 'required',
            'number_of_seats' => 'required|numeric|min:0|max:255'
        ];
    }
}
