<?php

declare(strict_types=1);

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

class BadHttpRequestException extends FrameworkException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}