<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetHistoricalData extends FormRequest
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
            'email' => 'required|email',
            'symbol' => 'required|alpha',
            'start_date' => 'required|date|before_or_equal:end_date|before:tomorrow',
            'end_date' => 'required|date|before:tomorrow|after_or_equal:start_date',
            'company_name' => 'string',
        ];
    }
}
