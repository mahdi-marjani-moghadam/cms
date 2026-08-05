<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CaptchaRule;

class CaptchaController extends Controller
{
    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'captcha' => 'required|captcha'
        ]);

        if (!CaptchaRule::validateCaptcha($request->captcha)) {
            return redirect()->back()->withErrors(['captcha' => 'Invalid captcha. Please try again.']);
        }

        return redirect()->back()->with('captcha_success', 'Hi, we received your request.');
    }

    public function reloadCaptcha()
    {
        $configCaptchaType = config('captcha.CAPTCHA_TYPE');

        $captchaType = '';

        if ($configCaptchaType == 0) {
            $captchaType = 'alphanumeric';
        } else {
            $captchaType = 'math';
        }

        $captchaImage = captcha_img($captchaType);

        return response()->json(['captcha' => $captchaImage]);
    }
}
