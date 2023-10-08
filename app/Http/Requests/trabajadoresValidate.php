<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class trabajadoresValidate extends FormRequest
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
            'name'=>[
                'required',
                'max:255',
            ],
            'num_doc'=>[
                'required',
                'max:20',
            ],
            'tip_doc','fech_nac','sexo','id_rol'=>'required',
            'num_tel'=>[
                'required',
                'max:10',
            ],
            'email'=>[
                'required',
                'max:255',
            ]
        ];
    }

    public function attributes()
    {
        return  [
            'tip_doc'=>'Tipo de Documento',
            'num_doc'=>'Numero de Documento',
            'fech_nac'=>'Fecha de Nacimiento',
            'num_tel'=>'Numero Telefonico',
            'email'=>'Correo Electronico',
            'password'=>'Contraseña'
        ];
        
    }
}
