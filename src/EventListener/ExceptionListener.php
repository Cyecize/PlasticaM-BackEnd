<?php


namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class ExceptionListener
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Registered in services.yaml.
     *
     * @param ExceptionEvent $event
     */
    public function onException(ExceptionEvent $event)
    {
        $this->onNotFoundException($event);
    }

    private function onNotFoundException(ExceptionEvent $event): bool
    {
        $exception = $event->getThrowable();
        if ($exception instanceof NotFoundHttpException) {
            $path = $event->getRequest()->getPathInfo();
            if (str_starts_with($path, "/api") || str_starts_with($path, "api")) {
                return true;
            }

            $response = new Response();
            $response->setContent($this->twig->render("index.html", []));
            $event->setResponse($response);

            return true;
        }

        return false;
    }
}