<?php

namespace App\Http\Requests;

use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
        $gender = implode(',', Driver::GENDER);
        $method = $this->method();
        if ($method == 'PATCH') {
            return [
                'registration_number' => 'sometimes|required|unique:drivers',
                'name' => 'sometimes|required',
                'phone' => 'sometimes',
                'address' => 'sometimes',
                'gender' => 'sometimes|required|in:'.$gender
            ];
        } else {
            return [
                'registration_number' => 'required|unique:drivers',
                'name' => 'required',
                'phone' => '',
                'address' => '',
                'gender' => 'required|in:'.$gender
            ];
        }
    }
}
