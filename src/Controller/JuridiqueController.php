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
    /**
     * @Route("/essai", name="app_essai")
     */
    public function essai(): Response
    {
        return $this->render('juridique/essai.html.twig', [
            'controller_name' => 'JuridiqueController',
        ]);
    }
    /**
     * @Route("/achat", name="app_achat")
     */
    public function achat(): Response
    {
        return $this->render('juridique/achat.html.twig', [
            'controller_name' => 'achatController',
        ]);
    }
}
