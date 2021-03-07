<?php

namespace App\Utils;

class Pageable
{
    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $page;

    public function __construct(int $page = 1, int $size = 10)
    {
        $this->page = $page;
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size || 10;
    }

    public function getPage(): int
    {
        return $this->page || 1;
    }
}