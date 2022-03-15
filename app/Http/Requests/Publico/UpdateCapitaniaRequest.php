<?php

namespace App\Http\Requests\Publico;

use App\Models\Publico\Capitania;
use Illuminate\Foundation\Http\FormRequest;


class UpdateCapitaniaRequest extends FormRequest
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
        $rules = Capitania::$rules;

        return $rules;
    }
}
