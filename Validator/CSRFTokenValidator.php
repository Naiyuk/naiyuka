<?php

declare(strict_types=1);

namespace Framework\Validator;

class CSRFTokenValidator extends Validator
{
	private int $minLength;

	public function __construct(string $error)
	{
        $this->error = $error;
	}

	public function isValid($value): bool
	{
        return !empty($_SESSION['token']) && !empty($value) && $_SESSION['token'] === $value;
    }
}