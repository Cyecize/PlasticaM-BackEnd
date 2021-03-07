<?php


namespace App\Utils;


use Symfony\Component\Validator\ConstraintViolationInterface;

class CustomConstraint implements ConstraintViolationInterface
{

    private $message;

    private $propertyPath;

    public function __construct(string $propertyPath, string $message)
    {
        $this->propertyPath = $propertyPath;
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getMessageTemplate()
    {
        // TODO: Implement getMessageTemplate() method.
    }

    public function getParameters()
    {
        // TODO: Implement getParameters() method.
    }

    public function getPlural()
    {
        // TODO: Implement getPlural() method.
    }

    public function getRoot()
    {
        // TODO: Implement getRoot() method.
    }

    public function getPropertyPath()
    {
        return $this->propertyPath;
    }

    public function getInvalidValue()
    {
        // TODO: Implement getInvalidValue() method.
    }

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }
}