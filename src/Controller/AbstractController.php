<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected Request $request;
    protected Response $response;
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../var/cache',
            'auto_reload' => true
        ]);
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
    }

    protected function render(string $view, array $params): Response
    {
        $template = $this->twig->render($view, $params);
        $this->response->setContent($template);

        return $this->response;
    }

    protected function json($data): Response
    {
        $this->response->headers->set('Content-Type', 'application/json');
        $this->response->setContent(json_encode($data));

        return $this->response;
    }

    protected function notFound(string $message): Response
    {
        $this->response->setStatusCode(404);
        $this->response->setContent($message);

        return $this->response;
    }

    protected function redirect(string $url): Response
    {
        $this->response->setStatusCode(302);
        $this->response->headers->set('Location', $url);

        return $this->response;
    }
}