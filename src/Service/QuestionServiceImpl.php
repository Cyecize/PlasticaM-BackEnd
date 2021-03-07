<?php

namespace App\Service;

use App\BindingModel\QuestionBindingModel;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Utils\DateUtils;
use App\Utils\ModelMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class QuestionServiceImpl implements QuestionService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository|QuestionRepository
     */
    private $questionRepo;

    /**
     * @var ModelMapper
     */
    private $modelMapper;

    public function __construct(EntityManagerInterface $entityManager, ModelMapper $modelMapper)
    {
        $this->entityManager = $entityManager;
        $this->modelMapper = $modelMapper;
        $this->questionRepo = $entityManager->getRepository(Question::class);
    }

    public function createQuestion(QuestionBindingModel $bindingModel): Question
    {
        $question = $this->modelMapper->map($bindingModel, Question::class);
        $question->setDate(DateUtils::getNow());
        $this->entityManager->persist($question);
        $this->entityManager->flush();
        return $question;
    }

    public function findOneById(int $id): ?Question
    {
        return $this->questionRepo->find($id);
    }
}