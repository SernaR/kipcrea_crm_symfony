<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/customers", name="customers")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/", name="_customers")
     */
    public function index(CustomerRepository $repo)
    {
        $customers = $repo->findAll();
        return $this->json( $customers);
    }
}
