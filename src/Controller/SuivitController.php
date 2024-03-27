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

/**
 * @Route("/suivit")
 */
class SuivitController extends AbstractController
{
    /**
     * @Route("/", name="app_suivit_index", methods={"GET"})
     */
    public function index(Request $request, SuivitRepository $suivitRepository): Response
    {
        $suivit= new Suivit();
        $form = $this->createForm(SuivitFilterType::class, null, [
            'data_class' => Avis::class,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->render('suivit/index.html.twig', [
                'suivits' => $suivitRepository->findAll(),
                'form' => $form->createView(),
            ]);
        }

        return $this->renderForm('suivit/index.html.twig', [
            'suivit' => $suivit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/get-sujets", name="get_sujets")
     */
    public function getSujets(Request $request, SuivitRepository $suivitRepository)
    {
        $natureId = $request->query->get('natureId');
        $sujets = $suivitRepository->findByNature($natureId); // Implémentez cette méthode dans votre repository

        $formattedSujets = [];
        foreach ($sujets as $sujet) {
            $formattedSujets[] = [
                'id' => $sujet->getId(),
                'nature' => $sujet->getNature(),
                'sujet' => $sujet->getSujet(),
                'cout' => $sujet->getCout(),
                'proprietaire' => $sujet->getProprietaire(),
                'debut' => $sujet->getDebut()->format('Y-m-d'), // Formatage de la date
                'fin' => $sujet->getFin()->format('Y-m-d'), // Formatage de la date
                'jourDeRetard' => $sujet->getJourDeRetard(),
                'causeRetard' => $sujet->getCauseRetard(),
                'dateCauseResiliation' => $sujet->getDateCauseResiliation(),
                'dateValidationFinal' => $sujet->getDateValidationFinal() ? $sujet->getDateValidationFinal()->format('Y-m-d') : null, // Formatage de la date ou null si non défini
            ];
        }

        return new JsonResponse($formattedSujets);
    }
    /**
     * @Route("/new", name="app_suivit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SuivitRepository $suivitRepository): Response
    {
        $suivit = new Suivit();
        $form = $this->createForm(SuivitType::class, $suivit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $suivitRepository->add($suivit, true);

            return $this->redirectToRoute('app_suivit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('suivit/new.html.twig', [
            'suivit' => $suivit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_suivit_show", methods={"GET"})
     */
    public function show(Suivit $suivit): Response
    {
        return $this->render('suivit/show.html.twig', [
            'suivit' => $suivit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_suivit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Suivit $suivit, SuivitRepository $suivitRepository): Response
    {
        $form = $this->createForm(SuivitType::class, $suivit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $suivitRepository->add($suivit, true);

            return $this->redirectToRoute('app_suivit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('suivit/edit.html.twig', [
            'suivit' => $suivit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_suivit_delete", methods={"POST"})
     */
    public function delete(Request $request, Suivit $suivit, SuivitRepository $suivitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $suivit->getId(), $request->request->get('_token'))) {
            $suivitRepository->remove($suivit, true);
        }

        return $this->redirectToRoute('app_suivit_index', [], Response::HTTP_SEE_OTHER);
    }
}
