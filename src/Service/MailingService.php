<?php

namespace App\Service;

use App\Entity\Question;

interface MailingService
{
    /**
     * @param Question $question
     */
    public function sendQuestionToAdmins(Question $question): void;
}