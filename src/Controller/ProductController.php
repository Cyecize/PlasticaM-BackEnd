<?php


namespace App\Controller;

use App\BindingModel\ProductQuery;
use App\Entity\Image;
use App\Service\ProductService;
use App\Service\ProductSpecificationService;
use App\Utils\ModelMapper;
use App\ViewModel\ProductSpecificationViewModel;
use App\ViewModel\ProductViewModel;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route(path="/api")
 */
class ProductController extends BaseController
{

    private $productService;

    private $productSpecificationService;

    private $modelMapper;

    public function __construct(ProductService $productService,
                                ModelMapper $modelMapper,
                                ProductSpecificationService $productSpecificationService)
    {
        $this->productService = $productService;
        $this->productSpecificationService = $productSpecificationService;
        $this->modelMapper = $modelMapper;
    }

    /**
     * @Rest\Post(path="/products")
     * @ParamConverter("productQuery", converter="fos_rest.request_body")
     * @param ProductQuery $productQuery
     * @param ConstraintViolationListInterface $errors
     * @return View
     */
    public function getProducts(ProductQuery $productQuery, ConstraintViolationListInterface $errors): View
    {
        if (count($errors) > 0) {
            return $this->fieldErrorView($errors);
        }

        $productPage = $this->productService->searchProducts($productQuery);

        $productPage->setElements(array_map(function ($prod) {
            return $this->modelMapper->map($prod, ProductViewModel::class);
        }, $productPage->getElements()));

        return $this->view($productPage);
    }

    /**
     * @Rest\Get(path="/products/{id}", defaults={"id": -1})
     * @param int $id
     * @return View
     */
    public function getProduct(int $id): View
    {
        $prod = $this->productService->findById($id);
        if ($prod == null) {
            return $this->view(null);
        }

        $viewModel = $this->modelMapper->map($prod, ProductViewModel::class);

        $viewModel->setCategoryNameEn($prod->getCategory()->getNameEn());
        $viewModel->setCategoryNameBg($prod->getCategory()->getNameBg());

        $viewModel->setGallery($prod->getImages()->map(function (Image $image) {
            return $image->getImageUrl();
        })->toArray());

        $viewModel->setSpecifications(array_map(function ($specification) {
            return $this->modelMapper->map($specification, ProductSpecificationViewModel::class);
        }, $this->productSpecificationService->getByProductId($id)));

        return $this->view($viewModel);
    }
}