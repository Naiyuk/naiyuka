<?php

declare(strict_types=1);

namespace Framework\Controller;

use App\Entity\User;
use Framework\{
    Form\Form,
    Entity\Entity,
    Form\FormType,
    Http\Response,
    Routing\Router,
    Manager\EntityManager
};

abstract class Controller
{
    protected Response $response;

    protected Router $router;

    protected Form $form;

    protected EntityManager $manager;

    protected function render(string $template, array $data = [], int $code = 200): string
    {
        $user = $this->getUser();
        $data['user'] = $user;

        $flashes = [];

        if (isset($_SESSION['flashes'])) {
            $flashes = $_SESSION['flashes'];
            unset($_SESSION['flashes']);
        }

        $data['flashes'] = $flashes;

        return $this->response->renderView($template, $data, $code);
    }

    protected function addFlash(string $type, string $message): void
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

    protected function getUser(): User
    {
        return unserialize($_SESSION['user'], ['allowed_classes' => [User::class]]);
    }

    protected function redirectToRoute(string $routeName, array $param = []): void
    {
        $url = $this->router->getUrlByRouteName($routeName, $param);

        $this->response->redirect($url);
    }

    protected function createForm(FormType $formType, Entity $entity): Form
    {
        $this->form->setEntity($entity);
        $formType->buildForm($this->form);

        return $this->form;
    }
}