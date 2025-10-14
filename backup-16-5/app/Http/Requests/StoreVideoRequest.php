<?php

namespace App\Http\Requests;

use App\Models\Video;
use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'strTitle' => [
                'required',
            ],
            'strUrl' => [
                'required',
            ],
        ];
    }
}
