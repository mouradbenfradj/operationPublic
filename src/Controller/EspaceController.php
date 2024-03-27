<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Suivit;
use App\Form\SuivitFilterType;
use App\Form\SuivitType;
use App\Repository\SuivitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class EspaceController extends AbstractController
{
    /**
     * @Route("/espace", name="app_espace", methods={"GET", "POST"})
     */
    public function index(Request $request, SuivitRepository $suivitRepository): Response
    {
        $form = $this->createForm(SuivitFilterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Retrieve filtered data and process it if needed
            // For example, you can fetch filtered data from the form and use it in the query
            $data = $form->getData();
            // You can add logic here to handle the filtered data

            // Render the template with the filtered results
            return $this->render('espace/index.html.twig', [
                'suivits' => $suivitRepository->findAll(),
                'form' => $form->createView(),
            ]);
        }

        // If form is not submitted or invalid, render the initial form
        return $this->render('espace/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
