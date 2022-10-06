<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('@EasyAdmin/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // TODO: set values
            ->setTitle('ACME Corp.')
            ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')
            ->setFaviconPath('favicon.svg')
            ->setTranslationDomain('my-custom-domain')

            ->setTextDirection('ltr')
            ->renderContentMaximized()
            ->renderSidebarMinimized()
            ->generateRelativeUrls()
            ->setLocales(['de', 'en'])
            ->setLocales([
                'de' => '🇬🇧 Deutsch',
                'en' => '🇬🇧 English',
            ])
            ->setLocales([
                'de',
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Customer', 'fas fa-phone', Customer::class);
    }
}
