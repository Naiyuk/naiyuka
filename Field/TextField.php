<?php

declare(strict_types=1);

namespace Framework\Field;

class TextField extends Field
{
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
            '<textarea class="form-control" id="%s" name="%s"',
            $this->name,
            $this->name
        );

		$field .= '>';

		if (!empty($this->value)) {
			$field .= htmlspecialchars($this->value);
		}

		$field .= '</textarea>';

		return sprintf('<div class="form-group">%s</div>', $field);
	}
}