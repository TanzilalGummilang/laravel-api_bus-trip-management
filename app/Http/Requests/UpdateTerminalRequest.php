<?php

namespace App\Http\Requests;

use App\Models\Terminal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTerminalRequest extends FormRequest
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
        $type = implode(',', Terminal::TYPE);
        $method = $this->method();
        if ($method == 'PATCH') {
            return [
                'code' => 'sometimes|required|unique:terminals',
                'name' => 'sometimes|required',
                'address' => 'sometimes|required',
                'province' => 'sometimes|required',
                'district' => 'sometimes|required',
                'sub_district' => 'sometimes|required',
                'type' => 'sometimes|required|in:'. $type
            ];
        } else {
            return [
                'code' => 'required|unique:terminals',
                'name' => 'required',
                'address' => 'required',
                'province' => 'required',
                'district' => 'required',
                'sub_district' => 'required',
                'type' => 'required|in:'. $type
            ];
        }
        
    }
}
