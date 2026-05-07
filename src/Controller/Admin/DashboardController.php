<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        //return parent::index();
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        return $this->redirect($adminUrlGenerator->setController(PhotoCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gallery Projet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Site principal', 'fa fa-home', 'app_photo');
        yield MenuItem::section('Contenu');
        yield MenuItem::linkTo(CategoryCrudController::class, 'Catégories', 'fas fa-list');
        yield MenuItem::linkTo(PhotoCrudController::class, 'Photos', 'fas fa-list');
        yield MenuItem::section('Gestion utilisateurs');
        yield MenuItem::linkTo(UserCrudController::class, 'Utilisateur', 'fa fa-users');
    }
}
