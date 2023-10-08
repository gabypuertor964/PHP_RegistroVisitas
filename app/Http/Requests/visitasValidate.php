<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class visitasValidate extends FormRequest
{

    protected $redirectRoute = 'visitas.index';
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
            'nombres','apellidos','tip_doc','num_doc','sexo','num_tel','id_trabajador','motivo_visita','codigo_gafete'=>"required",

            'nombres','apellidos'=>"max:30|min:3",
            'num_doc','num_tel'=>'min:7',
            'num_doc'=>'max:20',
            'num_tel'=>'max:10',
            'correo'=>'max:50',
            'motivo_visita','observaciones'=>'max:255',
            'codigo_gafete'=>'min:4|max:4',

        ];
    }
}
