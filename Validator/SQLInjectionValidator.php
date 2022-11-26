<?php

declare(strict_types=1);

namespace Framework\Validator;

class SQLInjectionValidator extends Validator
{
	public function __construct(string $error)
	{
		$this->error = $error;
    }

    public function isValid($value): bool
    {
        if (preg_match("#drop|delete|update|insert|union|select|where|like|create|set|join#i", $value)) {
            return false;
        }
        
        return true;
    }
    
}