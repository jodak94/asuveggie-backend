<?php

namespace Modules\Locales\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateLocalRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'nombre'  => 'required',
          'descripcion' => 'required',
          'latitud' => 'required',
          'longitud' => 'required',
          'telefono'     => 'required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
