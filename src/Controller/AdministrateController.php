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
    /**
     * @Route("/danger", name="app_danger")
     */
    public function danger(): Response
    {
        return $this->render('administrate/danger.html.twig', [
            'controller_name' => 'AdministrateController',
        ]);
    }
    /**
     * @Route("/temps", name="app_temps")
     */
    public function temps(): Response
    {
        return $this->render('administrate/temps.html.twig', [
            'controller_name' => 'AdministrateController',
        ]);
    }
    /**
     * @Route("/technologie", name="app_technologie")
     */
    public function technologie(): Response
    {
        return $this->render('administrate/technologie.html.twig', [
            'controller_name' => 'AdministrateController',
        ]);
    }
}
