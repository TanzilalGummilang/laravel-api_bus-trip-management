<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PATCH') {
            return [
                'number_plate' => 'sometimes|required|unique:buses',
                'serial_number' => 'sometimes|required|unique:buses',
                'distributor' => 'sometimes|required',
                'number_of_seats' => 'sometimes|required|numeric|min:0|max:255'
            ];
        } else {
            return [
                'number_plate' => 'required|unique:buses',
                'serial_number' => 'required|unique:buses',
                'distributor' => 'required',
                'number_of_seats' => 'required|numeric|min:0|max:255'
            ];
        }
    }
}
