<?php

declare(strict_types=1);

namespace Framework\Validator;

class MaxLengthValidator extends Validator
{
	private int $maxLength;

	public function __construct(string $error, int $maxLength)
	{
		$this->error = $error;     
        $this->maxLength = $maxLength;
	}

	public function isValid($value): bool
	{
		return (strlen($value) <= $this->maxLength);
	}
}