<?php

namespace App\Http\Requests;

use App\Design;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyDesignRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('design_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:design,id',
        ];
    }
}
