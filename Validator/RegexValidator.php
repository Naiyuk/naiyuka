<?php

declare(strict_types=1);

namespace Framework\Validator;

class RegexValidator extends Validator
{
    private string $pattern;

	private bool $match;

	public function __construct(string $error, string $pattern, bool $match = true)
	{
        $this->error = $error;
        $this->match = $match;
		$this->pattern = $pattern;
	}

	public function isValid($value): bool
	{
		$matching = preg_match($this->pattern, $value);
		
		if ($this->match === false && $matching === true) {
			$matching = false;
		} else if ($this->match === false && $matching === false) {
			$matching = true;
		}

		return (bool) $matching;
	}
}