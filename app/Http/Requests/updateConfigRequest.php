<?php

namespace yupiventas\Http\Requests;

use yupiventas\Http\Requests\Request;

class updateConfigRequest extends Request
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
        return [
            'empresa'           => 'required',
            'ruc'               => 'required',
            'serie_boleta'      => 'required',
            'correlativo_boleta'=> 'required'
        ];
    }
}
