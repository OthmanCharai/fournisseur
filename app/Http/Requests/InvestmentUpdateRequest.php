<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentUpdateRequest extends FormRequest
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
            'filing_date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'dead_line' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
