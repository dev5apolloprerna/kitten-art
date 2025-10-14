<?php

namespace App\Http\Requests;

use App\Profile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyProfileRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('company_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:profile,id',
        ];
    }
}
