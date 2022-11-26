<?php

declare(strict_types=1);

namespace Framework\Field;

use Framework\Validator\Validator;

abstract class Field
{
    protected string $name;

    protected mixed $value;

    protected string $label;

    protected string $error;

    protected bool $required = false;

    protected array $validators = [];

	public function __construct(array $options = [])
	{
		if (!empty($options)) {
			$this->hydrate($options);
		}
	}

	public function isValid(): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->error = $validator->getError();
                return false;
            }
        }
    
        return true;
    }

	public function hydrate(array $options): void
  	{
		foreach ($options as $key => $value) {

	      $method = 'set'.ucfirst($key);
	      
	      if (is_callable([$this, $method])) {

	        $this->$method($value);
	      }
	    }
    }

	abstract public function buildField();

    public function getName(): string
    {
    	return $this->name;
	}

    public function getRequired(): bool
    {
    	return $this->required;
    }

    public function getValue(): mixed
    {
    	return $this->value;
    }

    public function getLabel(): string
    {
    	return $this->label;
    }

    public function getValidators(): array
    {
        return $this->validators;
    }

    public function setName(string $name): void
    {
    	$this->name = $name;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    public function setValue(mixed $value): void
    {   	
    	$this->value = $value; 	
    }

    public function setLabel(string $label): void
    {	
    	$this->label = $label;
	}

	public function setValidators(array $validators): void
    {
        foreach ($validators as $validator) {
          if ($validator instanceof Validator && !in_array($validator, $this->validators, true)) {
			$this->validators[] = $validator;
          }
        }
	}

	public function unsetValidators(): void
	{
		$this->validators = [];
	}
}