<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrateController extends AbstractController
{
    /**
     * @Route("/administrate", name="app_administrate")
     */
    public function index(): Response
    {
        return $this->render('administrate/index.html.twig', [
            'controller_name' => 'AdministrateController',
        ]);
    }
}
