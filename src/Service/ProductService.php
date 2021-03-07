<?php


namespace App\Service;


use App\BindingModel\ProductQuery;
use App\Entity\Product;
use App\Utils\Page;

interface ProductService
{
    public function searchProducts(ProductQuery $query): Page;

    public function findById(int $id): ?Product;
}