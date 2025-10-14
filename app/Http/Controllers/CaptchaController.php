<?php

namespace App\Http\Controllers;

use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{
    public function generate()
    {
        return response()->json(['captcha' => Captcha::src()]);
    }
}
