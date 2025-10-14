<?php

namespace App\Http\Requests;

use App\Award;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyAwardRequest extends FormRequest
{
    // public function authorize()
    // {
        
    // }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:award,id',
        ];
    }
}
