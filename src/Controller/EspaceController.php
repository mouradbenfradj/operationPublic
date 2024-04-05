<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Suivit;
use App\Form\SuivitFilterType;
use App\Form\SuivitType;
use App\Repository\AvisRepository;
use App\Repository\SuivitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(Request $request, AvisRepository $avisRepository, EntityManagerInterface $entityManager): Response
    {
        $suivit = new Suivit();
        $form = $this->createForm(SuivitType::class, $suivit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($suivit->getAvis() as $key => $avi) {
                $avisRepository->add($avi, true);
                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );  
                $suivit = $avi->getOperation();
 
            }
            
            $form = $this->createForm(SuivitType::class, $suivit);
            return $this->render('espace/index.html.twig', [  'suivits' => [$suivit],'form' => $form->createView(),
        ]);
            }

        // If form is not submitted or invalid, render the initial form
        return $this->render('espace/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
