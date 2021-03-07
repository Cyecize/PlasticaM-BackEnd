<?php

namespace App\Service;

use App\Entity\Question;
use App\Exception\ApiException;
use Twig\Environment;

class MailingServiceImpl implements MailingService
{
    private const LOGGER_LOCATION = "Mailing Service";

    /**
     * @var MailSendingService
     */
    private $mailerService;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(MailSendingService $mailerService,
                                Environment $twig)
    {
        $this->mailerService = $mailerService;
        $this->twig = $twig;
    }

    public function sendQuestionToAdmins(Question $question): void
    {
        try {
            $content = $this->twig->render('mailing/new-question.html.twig', [
                'question' => $question
            ]);

            //TODO send to all admins when you add users.
            $receiver = "ceci2205@abv.bg";

            $this->mailerService->sendHtml("Plastica-M - Question", $content, $receiver);
            //$this->logger->log(self::LOGGER_LOCATION, sprintf("Sent email to %s admins", count($admins)));
        } catch (\Exception $ex) {
            //$this->logger->log(self::LOGGER_LOCATION, sprintf("Error while sending emails: %s" ,$ex->getMessage()));
            throw new ApiException("Error while sending email!", $ex);
        }
    }
}