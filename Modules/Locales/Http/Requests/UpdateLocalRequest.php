<?php

namespace Modules\Locales\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateLocalRequest extends BaseFormRequest
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
      return [
        'required'    => 'El campo :attribute no puede quedar vacio.',
        'unique' => 'El campo :attribute debe ser único. Ya existe ese valor.',
      ];
    }

    public function translationMessages()
    {
        return [];
    }
}
