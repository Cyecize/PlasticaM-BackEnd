<?php


namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
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
        // Logic moved to HomeController::index
        return false;
    }
}