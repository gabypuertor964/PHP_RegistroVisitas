<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class visitantesRequest extends FormRequest
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
            'nombres','apellidos','tip_doc','num_doc','sexo','num_tel'=>"required",

            'nombres','apellidos'=>"max:30|min:3",
            'num_doc','num_tel'=>'min:7',
            'num_doc'=>'max:20',
            'num_tel'=>'max:10',
            'correo'=>'max:50',
        ];
    }
}
