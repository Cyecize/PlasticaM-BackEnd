<?php

namespace App\Service;

use App\Entity\HomeCarousel;

interface HomeCarouselService
{
    /**
     * @return HomeCarousel[]
     */
    public function getAllVisible(): array;
}