<?php

namespace App\Http\Requests;

use App\Profile;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'strName' => [
                'required',
            ],
            'strDesignation' => [
                'required',
            ],
            'strUrlDisplayName' => [
                'required',
                'unique:profile'
            ],
            'iMobile' => [
                'required',
                //'unique:profile'
            ],
            'strEmail' => [
                'required',
                'unique:profile'
            ],
            'iDesginId' => [
                'required',
            ],
            'iType' => [
                'required',
            ],

        ];
    }
}
