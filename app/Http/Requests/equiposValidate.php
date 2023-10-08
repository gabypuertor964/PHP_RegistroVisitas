<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class equiposValidate extends FormRequest
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
            'serial','marca','tipo'=>'required',
            'serial'=>'max:255',
            'marca'=>'max:50',
            'tipo'=>'max:30'
        ];
    }
}
