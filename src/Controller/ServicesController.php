<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/services', name: 'services.')]
class ServicesController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(ServicesRepository $servicesRepository)
    {
        $services = $servicesRepository->findAll();
        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);

    }
}
