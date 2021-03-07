<?php

namespace App\BindingModel;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class QuestionBindingModel
{
    /**
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="50", maxMessage="invalidValue")
     * @Serializer\Type(name="string")
     */
    private $fullName;

    /**
     * @Assert\Length(max="50", maxMessage="invalidValue")
     * @Assert\Email(message="invalidValue")
     * @Serializer\Type(name="string")
     */
    private $email;

    /**
     * @Assert\Regex(pattern="/^(\+?[0-9]{9,12})$|^.{0}$/", message="invalidValue")
     * @Serializer\Type(name="string")
     */
    private $phoneNumber;

    /**
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="5000", maxMessage="invalidValue")
     * @Serializer\Type(name="string")
     */
    private $message;

    public function __construct()
    {
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getMessage()
    {
        return $this->message;
    }
}