<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrateController extends AbstractController
{
    /**
     * @Route("/administrate", name="app_administrate")
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('administrate/index.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(3),
        ]);
    }
    /**
     * @Route("/danger", name="app_danger")
     */
    public function danger(DocumentRepository $documentRepository): Response
    {
        return $this->render('administrate/danger.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(4),
        ]);
    }
    /**
     * @Route("/temps", name="app_temps")
     */
    public function temps(DocumentRepository $documentRepository):Response
    {
        return $this->render('administrate/temps.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(5),
        ]);
    }
    /**
     * @Route("/technologie", name="app_technologie")
     */
    public function technologie(DocumentRepository $documentRepository): Response
    {
        return $this->render('administrate/technologie.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(6),
        ]);
    }
}
