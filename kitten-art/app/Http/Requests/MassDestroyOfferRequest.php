<?php

namespace App\Http\Requests;

use App\Offer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyOfferRequest extends FormRequest
{
    // public function authorize()
    // {
        
    // }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:offer,id',
        ];
    }
}
