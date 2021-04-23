<?php

namespace App\Service;

interface ProductSpecificationService
{
    public function getByProductId(int $productId);
}