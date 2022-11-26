<?php

declare(strict_types=1);

namespace Framework\Validator;

class MinLengthValidator extends Validator
{
	private int $minLength;

	public function __construct(string $error, int $minLength)
	{
        $this->error = $error;
		$this->minLength = $minLength;
	}

	public function isValid($value): bool
	{
		return (strlen($value) >= $this->minLength);
	}
}