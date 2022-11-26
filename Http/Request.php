<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Exception\{BadHttpMethodException, BadHttpRequestException};

class Request
{
	public function getPostData(string $key): mixed
  	{
    	return $_POST[$key] ?? null;
  	}

	public function getGetData(string $key): mixed
	{
		return $_GET[$key] ?? null;
	}

	public function getSessionData(string $key): mixed
	{
		return $_SESSION[$key] ?? null;
	}

	public function getUrl(): string
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function getIp(): string
	{
		return $_SERVER['REMOTE_ADDR'];
	}

	public function setSessionData(string $key, mixed $value): void
	{
		$_SESSION[$key] = $value;
	}

	public function isMethod(string $method): bool
  	{
    	return ($_SERVER['REQUEST_METHOD'] === $method);
	}

	public function addFlash(string $type, string $message): void
	{
		if (isset($_SESSION['flashes'])) {
            $flashes = $_SESSION['flashes'];

            $flashes[$type][] = $message;
            $_SESSION['flashes'] = $flashes;

            return;
        }

        $flashes = [];
        $flashes[$type][] = $message;
        $_SESSION['flashes'] = $flashes;
	}

	public function isXmlHttpRequest(): bool
	{
		return ('XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH']);
	}

    /**
     * @throws BadHttpMethodException
     * @throws BadHttpRequestException
     */
	public function isAjaxRequest(string $method): ?bool
	{
		if (!$this->isXmlHttpRequest()) {
            throw new BadHttpRequestException('La syntaxe de la requête est erronée');
        }

        if (!$this->isMethod($method)) {
            throw new BadHttpMethodException('Méthode de requête non autorisée');
		}
		
		return true;
	}
}