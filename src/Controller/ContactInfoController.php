<?php


namespace App\Controller;


use App\Service\ContactInfoService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;

/**
 * @Route(path="/api")
 */
class ContactInfoController extends BaseController
{

    private $contactInfoService;

    public function __construct(ContactInfoService $contactInfoService)
    {
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * @Rest\Get(path="/contact-info")
     */
    public function getContactInfo(): View
    {
        return $this->view($this->contactInfoService->getContacts());
    }
}