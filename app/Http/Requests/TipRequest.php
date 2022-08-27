<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
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
            'team_a' => 'required|string',
            'team_b'  => 'required|string',
            'country_league'  => 'required|string',
            'other_score' => 'numeric',
            'correct_tip' => 'required|string',
            'correct_odd' => 'required|numeric',
            'match_time' => 'required',
            'is_vip' => 'required'
        ];
    }
}
