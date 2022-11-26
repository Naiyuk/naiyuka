<?php

declare(strict_types=1);

namespace Framework\Validator;

abstract class Validator
{
	protected string $error;

	abstract public function isValid($value);

	public function getError(): string
	{
		return $this->error;
    }

	public function setError(string $error): void
	{
		$this->error = $error;
	}
}