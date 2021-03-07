<?php


namespace App\Service;


use App\Entity\ProductCategory;

interface ProductCategoryService
{

    /**
     * @return ProductCategory[]
     */
    public function all(): array;
}