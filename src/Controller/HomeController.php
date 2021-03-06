<?php


namespace App\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;

/**
 * @Route(path="/api")
 */
class HomeController extends BaseController
{
    /**
     * @Rest\Get(path="/homes")
     * @return View
     */
    public function home()
    {
        return $this->view('what');
    }
}