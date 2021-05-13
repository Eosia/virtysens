<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Entity\Media;
use App\Entity\Membre;
use App\Entity\User;
use App\Entity\Category;
Use EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(MediaCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Virtysens Dashboard');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::section('Actions');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-archive', Category::class);
        yield MenuItem::linkToCrud('Médias', 'fa fa-newspaper-o', Media::class);
        yield MenuItem::linkToCrud('Jobs', 'fa fa-bullhorn', Job::class);

        yield MenuItem::section('Gestion des admins');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user-circle', User::class);

        yield MenuItem::section('Gestion de l\'équipe');
        yield MenuItem::linkToCrud('Membres', 'fas fa-users', Membre::class);

        yield MenuItem::section('Raccourcis');
        yield MenuItem::linkToUrl('Retour au site', 'fa fa-globe', '/');
        yield MenuItem::linkToUrl('Déconnexion', 'fas fa-sign-out-alt', '/admin/logout');

    }
}

