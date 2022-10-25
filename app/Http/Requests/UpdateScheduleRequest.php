<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
        $status = implode(',', Schedule::STATUS);
        $method = $this->method();
        if($method == 'PATCH'){
            return [
                'bus_id' => 'sometimes|required|exists:buses,id',
                'driver_id' => 'sometimes|required|exists:drivers,id',
                'route_id' => 'sometimes|required|exists:routes,id',
                'leave' => 'sometimes|required',
                'arrive' => 'sometimes',
                'status' => 'sometimes|required|in:'.$status
            ];
        } else {
            return [
                'bus_id' => 'required|exists:buses,id',
                'driver_id' => 'required|exists:drivers,id',
                'route_id' => 'required|exists:routes,id',
                'leave' => 'required',
                'arrive' => '',
                'status' => 'required|in:'.$status
            ];
        }
    }
}
