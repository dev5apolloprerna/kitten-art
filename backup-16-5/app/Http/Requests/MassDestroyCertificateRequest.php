<?php

namespace App\Http\Requests;

use App\Certificate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyCertificateRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('certificate_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:certificate,id',
        ];
    }
}
