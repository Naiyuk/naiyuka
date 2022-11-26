<?php

declare(strict_types=1);

namespace Framework\Form;

use Framework\{Field\Field, Http\Request, Entity\Entity};

class Form
{
	private Entity $entity;

	private array $fields = [];

	public function add(Field $field): void
	{
		$method = 'get'.ucfirst($field->getName());

		if (is_callable([$this->entity, $method])) {

			$field->setValue($this->entity->$method());
		
		}

		$this->fields[] = $field;
	}

	public function isValid(): bool
	{
		$valid = true;

		foreach ($this->fields as $field)  {
			if (!$field->getRequired() && empty($field->getValue())) {
				return true;
			}

			if (!$field->isValid()) {
				$valid = false;
			}
		}

		return $valid;
    }

    public function handleRequest(Request $request): void
    {
		if ($request->isMethod('POST')) {

			foreach ($this->fields as $field) {
				$value = $request->getPostData($field->getName());
				$field->setValue($value);

				$methodSet = 'set'.ucfirst($field->getName());
				$methodGet = 'get'.ucfirst($field->getName());

				if (!empty($this->entity->getId())) {
					if (is_callable([$this->entity, $methodGet]) && $this->entity->$methodGet() === $value) {
						$field->unsetValidators();
					}
				}

				if (is_callable([$this->entity, $methodSet])) {
					$this->entity->$methodSet($value);
				}
			}
		}
    }

	public function createView(): string
	{
		$form = '';

		foreach ($this->fields as $field)  {
			$form .= $field->buildField();
		}

		return $form;
    }

	public function getEntity(): Entity
	{
		return $this->entity;
    }

    public function setEntity(Entity $entity): void
    {
        $this->entity = $entity;
    }
}