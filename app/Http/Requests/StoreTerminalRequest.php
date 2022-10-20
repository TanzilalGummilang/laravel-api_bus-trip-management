<?php

namespace App\Http\Requests;

use App\Models\Terminal;
use Illuminate\Foundation\Http\FormRequest;

class StoreTerminalRequest extends FormRequest
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
