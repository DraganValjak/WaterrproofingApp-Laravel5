<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MaterijalUpdateRequest extends Request
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
        'naziv_materijala'  => 'required',
        'mjerna_jedinica'   => 'required',
        'cijena_materijala_po_jedinici'  => 'required|numeric',
        'rabat'  => 'numeric'
        ];
    }
}
