<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuridiqueController extends AbstractController
{
    /**
     * @Route("/juridique", name="app_juridique")
     */
    public function index(): Response
    {
        return $this->render('juridique/index.html.twig', [
            'controller_name' => 'JuridiqueController',
        ]);
    }
}
