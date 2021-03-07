<?php

namespace App\Service;

use App\BindingModel\QuestionBindingModel;
use App\Entity\Question;

interface QuestionService
{
    /**
     * @param QuestionBindingModel $bindingModel
     * @return Question
     */
    public function createQuestion(QuestionBindingModel $bindingModel) : Question;

    /**
     * @param int $id
     * @return Question|null
     */
    public function findOneById(int $id) : ?Question;
}