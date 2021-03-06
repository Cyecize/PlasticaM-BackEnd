<?php


namespace App\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Method called on each request that is not a part of the API.
     * Always loads index.html, which will then be processed by the FE.
     *
     * @Rest\Get(path="/", name="index")
     * @return View
     */
    public function index()
    {
        return $this->render('index.html');
    }
}