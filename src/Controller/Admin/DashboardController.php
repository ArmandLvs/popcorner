<?php

namespace App\Controller\Admin;

use App\Entity\Library;
use App\Entity\Movie;
use App\Entity\Member;
use App\Entity\Playlist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(LibraryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Popcorner');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Members', 'fas fa-list', Member::class);
        yield MenuItem::linkToCrud('Libraries', 'fas fa-list', Library::class);
        yield MenuItem::linkToCrud('Movies', 'fas fa-list', Movie::class);
        yield MenuItem::linkToCrud('Playlists', 'fas fa-list', Playlist::class);
    }
}
