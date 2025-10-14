<?php

namespace App\Http\Requests;

use App\Profile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'strName' => [
                'required',
            ],
            'strDesignation' => [
                'required',
            ],
            'iMobile' => [
                'required',
                //'unique:profile'
            ],
            'strEmail' => [
                'required',
                //'unique:profile'
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
