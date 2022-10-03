<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncidentRequest extends FormRequest
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
            'code' => ['required', 'max:5'],
            'name' => ['required', 'max:100'],
            'description' => ['required'],
            'start_date' => ['required', 'date'],
            'finish_date' => ['required', 'date'],
            'sac_activation' => ['required', 'boolean'],
            'root_cause' => ['required'],
            'response_actions' => ['required']
        ];
    }
}
