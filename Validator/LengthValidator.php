<?php

declare(strict_types=1);

namespace Framework\Validator;

class LengthValidator extends Validator
{
	private int $length;

	public function __construct(string $error, int $length)
	{
		$this->error = $error;     
        $this->length = $length;
	}

	public function isValid($value): bool
	{
		return (strlen($value) === $this->length);
	}
}