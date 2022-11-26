<?php

declare(strict_types=1);

namespace Framework\Field;

class StringField extends Field
{
	private string $type = 'text';

	public function buildField(): string
	{
		$field = '';

		if (!empty($this->label)) {
			$field .= sprintf(
                '<label class="control-label text-dark" for="%s">%s</label>',
                $this->name,
                $this->label
            );
		}
		
		if (!empty($this->error)) {
			$field .= sprintf(
                '<span class="invalid-feedback d-block font-weight-bold">%s</span>',
                $this->error
            );
		}

		$field .= sprintf(
            '<input class="form-control" type="%s" id="%s" name="%s"',
            $this->type,
            $this->name,
            $this->name
        );

		if (!empty($this->value)) {
			$field .= sprintf(' value="%s"', htmlspecialchars($this->value));
		}

		$field .= ' />';

		return sprintf('<div class="form-group">%s</div>', $field);
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type): void
	{
		$this->type = $type;
	}
}