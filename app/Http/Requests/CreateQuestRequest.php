<?php

namespace App\Http\Requests;

use App\Models\Quest;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Quest::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'reward_xp' => 'required|numeric',
            'reward_coins' => 'required|numeric',
            'objectives' => 'required|array|min:1',
            'objectives.*.name' => 'required',
            'objectives.*.goal' => 'required|numeric',
        ];
    }
}
