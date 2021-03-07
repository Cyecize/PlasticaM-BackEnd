<?php


namespace App\BindingModel;


use App\Utils\Pageable;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class PageQuery extends Pageable
{
    /**
     * @var int
     * @Serializer\Type(name="int")
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\GreaterThan(value="0", message="page cannot be less than 1")
     */
    private $page;

    /**
     * @var int
     * @Serializer\Type(name="int")
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $size;

    public function getPage(): int
    {
        return $this->page;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}