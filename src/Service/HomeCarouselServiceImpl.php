<?php

namespace App\Service;

use App\Entity\HomeCarousel;
use Doctrine\ORM\EntityManagerInterface;

class HomeCarouselServiceImpl implements HomeCarouselService
{

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(HomeCarousel::class);
    }

    public function getAllVisible(): array
    {
        return $this->repository->findBy(['enabled' => true], ['orderNumber' => 'ASC']);
    }
}