<?php


namespace App\Controller;

use App\Service\ProductCategoryService;
use App\Utils\ModelMapper;
use App\ViewModel\ProductCategoryViewModel;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api")
 */
class ProductCategoryController extends BaseController
{

    private $modelMapper;

    private $categoryService;

    public function __construct(ModelMapper $modelMapper,
                                ProductCategoryService $categoryService)
    {
        $this->modelMapper = $modelMapper;
        $this->categoryService = $categoryService;
    }

    /**
     * @Rest\Get(path="/categories")
     */
    public function allCategories(): View
    {
        $categories = array_map(function ($item) {
            return $this->modelMapper->map($item, ProductCategoryViewModel::class);
        }, $this->categoryService->all());

        return $this->view($categories);
    }
}