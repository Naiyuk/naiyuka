<?php

declare(strict_types=1);

namespace Framework\Validator;

use ReCaptcha\ReCaptcha;
use Framework\Http\Request;

class CaptchaValidator extends Validator
{
    private Recaptcha $captcha;

    private Request $request;

    public function __construct(string $captchaKey, Request $request)
    {
        $this->captcha = new ReCaptcha($captchaKey);
        $this->request = $request;
    }

    public function isValid($value): bool
    {
        $resp = $this->captcha->verify($value, $this->request->getIp());

        if (!$resp->isSuccess()) {
            return false;
        }

        return true;
    }
}