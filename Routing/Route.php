<?php

declare(strict_types=1);

namespace Framework\Routing;

class Route
{
    private string $url;

    private string $controller;

    private string $action;

    private string $name;

    private string $mask;

	private array $varsNames;

	private array $vars = [];

	public function hasVars(): bool
	{
		return !empty($this->varsNames);
	}

	public function match(string $url): mixed
	{
		if (preg_match('`^'.$this->url.'$`', $url, $matches)) {
			return $matches;
		}

        return false;
    }

	public function setUrl(string $url): void
	{	
		$this->url = $url;
    }

	public function setController(string $controller): void
	{
		$this->controller = $controller;
    }

	public function setAction(string $action): void
	{
		$this->action = $action;
    }

	public function setName(string $name): void
	{
		$this->name = $name;
    }

	public function setMask(string $mask): void
	{
		$this->mask = $mask;
	}

	public function setVarsNames(?array $varsNames): void
	{
		$this->varsNames = $varsNames;
	}

	public function setVars(?array$vars): void
	{
		$this->vars = $vars;
	}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMask(): string
    {
        return $this->mask;
    }

    public function getVarsNames(): ?array
    {
        return $this->varsNames;
    }

    public function getVars(): ?array
    {
        return $this->vars;
    }
}