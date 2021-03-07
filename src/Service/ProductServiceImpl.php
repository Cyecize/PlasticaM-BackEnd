<?php

namespace App\Service;

use App\BindingModel\ProductQuery;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Utils\Page;
use Doctrine\ORM\EntityManagerInterface;

class ProductServiceImpl implements ProductService
{

    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Product::class);
    }

    public function searchProducts(ProductQuery $query): Page
    {
        return $this->repository->search($query);
    }

    public function findById(int $id): ?Product
    {
        return $this->repository->findOneBy(['id' => $id, 'enabled' => true]);
    }
}