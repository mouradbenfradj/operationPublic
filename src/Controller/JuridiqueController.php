<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuridiqueController extends AbstractController
{
    /**
     * @Route("/juridique", name="app_juridique")
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('juridique/index.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(1),
        ]);
    }
    /**
     * @Route("/essai", name="app_essai")
     */
    public function essai(DocumentRepository $documentRepository): Response
    {
        return $this->render('juridique/essai.html.twig', [
            'documents' => $documentRepository->findByMenuCyble(2),
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
