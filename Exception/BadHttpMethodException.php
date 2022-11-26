<?php

declare(strict_types=1);

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

class BadHttpMethodException extends FrameworkException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 405);
    }
}