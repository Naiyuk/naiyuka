<?php

declare(strict_types=1);

namespace Framework\Validator;

class NotNullValidator extends Validator
{
    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public function isValid($value): bool
    {
        return !empty($value);
    }
}