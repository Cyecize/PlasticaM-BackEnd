<?php


namespace App\BindingModel;


use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class SortQuery
{

    /**
     * @Serializer\Type(name="string")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     */
    private $field;

    /**
     * @Serializer\Type(name="string")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Regex(pattern="/^(asc|desc)$/", message="invalidValue")
     */
    private $direction;

    public function getField()
    {
        return $this->field;
    }

    public function getDirection()
    {
        return $this->direction;
    }
}