<?php


namespace App\BindingModel;


use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ProductQuery
 * @package App\BindingModel
 */
class ProductQuery
{

    /**
     * @var SortQuery|null
     * @Serializer\Type(SortQuery::class)
     * @Assert\Valid()
     */
    private $sort;

    /**
     * @var PageQuery
     * @Serializer\Type(PageQuery::class)
     * @Assert\NotNull(message="Page Info cannot be null")
     * @Assert\Valid()
     */
    private $page;

    /**
     * @var string[]|null
     * @Serializer\Type(name="array")
     */
    private $categoryIds;

    /**
     * @var string|null
     * @Serializer\Type(name="string")
     */
    private $search;

    public function __construct()
    {

    }

    public function getSort(): ?SortQuery
    {
        return $this->sort;
    }

    public function getPage(): PageQuery
    {
        return $this->page;
    }

    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }
}