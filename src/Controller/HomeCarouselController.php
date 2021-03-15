<?php


namespace App\Controller;

use App\Entity\HomeCarousel;
use App\Service\HomeCarouselService;
use App\Utils\ModelMapper;
use App\ViewModel\HomeCarouselViewModel;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;

/**
 * @Route(path="/api")
 */
class HomeCarouselController extends BaseController
{

    private $homeCarouselService;

    private $modelMapper;

    public function __construct(HomeCarouselService $homeCarouselService,
                                ModelMapper $modelMapper)
    {
        $this->homeCarouselService = $homeCarouselService;
        $this->modelMapper = $modelMapper;
    }

    /**
     * @Rest\Get(path="/home-carousel")
     */
    public function getHomeCarouselItems(): View
    {
        return $this->view(array_map(function (HomeCarousel $carousel) {
            return $this->modelMapper->map($carousel, HomeCarouselViewModel::class);
        }, $this->homeCarouselService->getAllVisible()));
    }
}