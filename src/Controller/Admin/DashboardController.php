<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Suivit;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OperationPublic');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Suivit', 'fas fa-list', Suivit::class);
        yield MenuItem::linkToCrud('Contacte', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
    }
}
