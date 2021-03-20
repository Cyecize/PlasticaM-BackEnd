<?php


namespace App\BindingModel;


use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class LoginBindingModel
{

    /**
     * @var string
     * @Serializer\Type(name="string")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     */
    private $username;

    /**
     * @var string
     * @Serializer\Type(name="string")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     */
    private $password;

    public function __construct()
    {

    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}