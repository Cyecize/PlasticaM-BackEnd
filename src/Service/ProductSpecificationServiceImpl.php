<?php

namespace App\Service;

use App\Entity\ProductSpecification;
use App\Repository\ProductSpecificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductSpecificationServiceImpl implements ProductSpecificationService
{
    private $entityManager;

    /**
     * @var ProductSpecificationRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(ProductSpecification::class);
    }

    public function getByProductId(int $productId)
    {
        return $this->repository->findBy(['productId' => $productId]);
    }
}