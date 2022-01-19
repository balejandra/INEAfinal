<?php

namespace App\Http\Requests\Publico;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Publico\Menu_rol;

class CreateMenu_rolRequest extends FormRequest
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
        return Menu_rol::$rules;
    }
}
