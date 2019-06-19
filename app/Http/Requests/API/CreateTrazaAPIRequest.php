<?php

namespace App\Http\Requests\API;

use App\Models\Traza;
use InfyOm\Generator\Request\APIRequest;

class CreateTrazaAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Traza::$rules;
    }
}
