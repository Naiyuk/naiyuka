<?php

declare(strict_types=1);

namespace Framework\Http;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public const VIEWS_DIR = __DIR__.'/../../app/views';

    private \Twig_Environment $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(self::VIEWS_DIR);
	   	$this->twig = new \Twig\Environment($loader); 
    }

	#[NoReturn]
    public function redirect(string $location): void
	{
        header("Location: ".$location);
        exit;
    }

    public function renderView(string $template, array $data = [], int $code = 200): string
    {
        http_response_code($code);

        return $this->twig->render($template, $data);
    }

    /**
     * @throws \JsonException
     */
    public function json($data, int $code = 200): ?string
    {
        $json = json_encode($data, JSON_THROW_ON_ERROR);
        http_response_code($code);

        return $json;
    }

	public function endSession(): void
	{
		$_SESSION = array();
       	session_destroy();
	}
}