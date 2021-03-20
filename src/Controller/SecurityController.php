<?php

namespace App\Controller;

use App\BindingModel\LoginBindingModel;
use App\Service\AuthTokenService;
use App\Service\UserService;
use App\Utils\CustomConstraint;
use App\Utils\ModelMapper;
use App\ViewModel\AuthTokenViewModel;
use App\ViewModel\UserViewModel;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class SecurityController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class SecurityController extends BaseController
{

    private $userService;

    private $authTokenService;

    private $modelMapper;

    public function __construct(UserService $userService,
                                AuthTokenService $authTokenService,
                                ModelMapper $modelMapper)
    {
        $this->userService = $userService;
        $this->authTokenService = $authTokenService;
        $this->modelMapper = $modelMapper;
    }

    /**
     * @Rest\Post(path="/login")
     * @ParamConverter("loginBindingModel", converter="fos_rest.request_body")
     * @Security("is_anonymous()", message="youAreAlreadyLoggedIn")
     * @param LoginBindingModel $loginBindingModel
     * @param ConstraintViolationListInterface $errors
     * @return View
     */
    public function login(LoginBindingModel $loginBindingModel, ConstraintViolationListInterface $errors): View
    {
        if (count($errors) > 0) {
            return $this->fieldErrorView($errors);
        }

        $user = $this->userService->findOneByUsernameOrEmail($loginBindingModel->getUsername());
        if ($user == null) {
            $errors->add(new CustomConstraint('username', 'usernameNotFound'));
            return $this->fieldErrorView($errors);
        }

        if (!password_verify($loginBindingModel->getPassword(), $user->getPassword())) {
            $errors->add(new CustomConstraint('password', 'invalidPassword'));
            return $this->fieldErrorView($errors);
        }
        
        $authToken = $this->authTokenService->create($user);

        return $this->view($this->modelMapper->map($authToken, AuthTokenViewModel::class));
    }

    /**
     * @Rest\Get(path="/user-details")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return View
     */
    public function userDetails(): View
    {
        return $this->view($this->modelMapper->map($this->getUser(), UserViewModel::class));
    }

    /**
     * @Rest\Post (path="/logout")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function logout(): View
    {
        $this->authTokenService->removeByUser($this->getUser());
        return $this->view(['message' => 'Logged out successfully!']);
    }
}