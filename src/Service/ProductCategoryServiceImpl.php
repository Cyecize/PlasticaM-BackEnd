<?php


namespace App\Service;

use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductCategoryServiceImpl implements ProductCategoryService
{

    /**
     * @var ProductCategoryRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(ProductCategory::class);
    }

    public function all(): array
    {
        return $this->repository->findAll();
    }
}