<?php

namespace App\Http\Requests;

use App\Certificate;
use Gate;
use App\PaymentDetail;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyPaymentDetailRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('payment_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:payment_detail,id',
        ];
    }
}
