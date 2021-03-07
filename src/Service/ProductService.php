<?php


namespace App\Service;


use App\BindingModel\ProductQuery;
use App\Utils\Page;

interface ProductService
{
    public function searchProducts(ProductQuery $query): Page;
}