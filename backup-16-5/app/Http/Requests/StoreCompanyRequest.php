<?php

namespace App\Http\Requests;

use App\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class StoreCompanyRequest extends FormRequest
{
    

    public function rules()
    {
        return [
            'strName' => [
                'required',
            ],
            'strContactPerson' => [
                'required',
            ],
            'strEmail' => [
                'required',
            ],
            'iMobile' => [
                'required',
                'unique:company'
            ],
           
        ];
    }
}
