<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MaterijalFormUpdateRequest extends Request
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
        'potrosnja_mat' => 'required|numeric|min:0.001|between:0,9999.999',
        'kalkul_sat' => 'required|numeric|min:0.001|between:0,9999.999',
        'minuta' => 'required|numeric|min:0.001|between:0,9999.999',
        'norma_sat' => 'required|numeric|min:0.001|between:0,9999.999'    
        ];
    }
}
