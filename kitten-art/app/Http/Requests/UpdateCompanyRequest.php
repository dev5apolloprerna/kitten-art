<?php

namespace App\Http\Requests;

use App\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            ],
        ];
    }
}
