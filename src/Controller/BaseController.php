<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class BaseController extends AbstractFOSRestController
{
    protected function fieldErrorView(ConstraintViolationListInterface $errors): View
    {
        $formattedErrors = [];

        foreach ($errors as $error) {
            $formattedErrors[] = ['propertyPath' => $error->getPropertyPath(), 'message' => $error->getMessage()];
        }

        return $this->view($formattedErrors, 406);
    }

    protected function operationSuccessful(string $message = null): View
    {
        $response = ['status' => 200];
        if ($message != null) {
            $response['message'] = $message;
        }

        return $this->view($response);
    }
}