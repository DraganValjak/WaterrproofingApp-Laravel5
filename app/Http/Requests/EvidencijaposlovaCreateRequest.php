<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EvidencijaposlovaCreateRequest extends Request
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
        'mjesto_rada'  => 'required',
        'narucitelj'   => 'required',
        'narucitelj_adresa'  => 'required',
        'narucitelj_oib'  => 'required',
        ];
    }
}
