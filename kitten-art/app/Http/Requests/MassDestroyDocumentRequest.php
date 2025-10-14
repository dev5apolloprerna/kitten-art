<?php

namespace App\Http\Requests;

use App\Document;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('permission_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:document,id',
        ];
    }
}
