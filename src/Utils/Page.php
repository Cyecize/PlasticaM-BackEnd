<?php

namespace App\Utils;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JMS\Serializer\Annotation as Serializer;

class Page
{

    /**
     * @var int
     */
    private $pages;

    /**
     * @var int
     */
    private $itemsCount;

    /**
     * @var Pageable
     */
    private $pageable;

    /**
     * @var array
     */
    private $elements;

    /**
     * @var Paginator
     * @Serializer\Exclude()
     */
    private $paginator;

    public function __construct(QueryBuilder $query, Pageable $pageable)
    {
        $this->pageable = $pageable;
        $this->paginator = new Paginator($query);
        $this->init();
    }

    private function init(){
        $this->itemsCount = $this->paginator->count();
        $this->pages = ceil($this->itemsCount / $this->pageable->getSize());
        $this->paginator
            ->getQuery()
            ->setFirstResult($this->pageable->getSize() * ($this->pageable->getPage()-1)) // set the offset
            ->setMaxResults($this->pageable->getSize()); // set the limit
        $this->elements = $this->paginator->getIterator()->getArrayCopy();
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @return int
     */
    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    /**
     * @return Pageable
     */
    public function getPageable(): Pageable
    {
        return $this->pageable;
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param array $elements
     */
    public function setElements(array $elements): void
    {
        $this->elements = $elements;
    }
}