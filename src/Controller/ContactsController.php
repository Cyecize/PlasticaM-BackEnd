<?php


namespace App\Controller;


use App\BindingModel\QuestionBindingModel;
use App\Service\ContactInfoService;
use App\Service\MailingService;
use App\Service\QuestionService;
use App\Utils\CustomConstraint;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route(path="/api")
 */
class ContactsController extends BaseController
{

    private $contactInfoService;

    private $questionService;

    private $mailingService;

    private $validator;

    public function __construct(ContactInfoService $contactInfoService,
                                QuestionService $questionService,
                                MailingService $mailSendingService,
                                ValidatorInterface $validator)
    {
        $this->contactInfoService = $contactInfoService;
        $this->questionService = $questionService;
        $this->mailingService = $mailSendingService;
        $this->validator = $validator;
    }

    /**
     * @Rest\Get(path="/contact-info")
     */
    public function getContactInfo(): View
    {
        return $this->view($this->contactInfoService->getContacts());
    }

    /**
     * @Rest\Post(path="/question")
     * @ParamConverter("questionBindingModel", converter="fos_rest.request_body")
     * @param QuestionBindingModel $questionBindingModel
     * @param ConstraintViolationListInterface $errors
     * @return View
     */
    public function sendQuestion(QuestionBindingModel $questionBindingModel,
                                 ConstraintViolationListInterface $errors): View
    {
        if (count($errors) < 1) {
            if ($questionBindingModel->getEmail() == null && $questionBindingModel->getPhoneNumber() == null) {
                $errors->add(new CustomConstraint('email', 'Email or phone number is required!'));
                return $this->fieldErrorView($errors);
            }

            $question = $this->questionService->createQuestion($questionBindingModel);
            $this->mailingService->sendQuestionToAdmins($question);
            return $this->operationSuccessful('Question was sent!');
        }

        return $this->fieldErrorView($errors);
    }
}