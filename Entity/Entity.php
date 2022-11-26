<?php

declare(strict_types=1);

namespace Framework\Entity;

abstract class Entity
{
    protected mixed $id;

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}