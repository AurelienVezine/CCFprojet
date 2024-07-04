<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
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
    #[Route('/{id}-{nom}', name: 'show', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function show(Request $request, ServicesRepository $servicesRepository, int $id, string $nom)
    {
        $services = $servicesRepository->find($id);
        if ($services->getNom()!== $nom) {
            return $this->redirectToRoute('service.show', ['nom' => $nom->getNom(), 'id' => $id], 301);
        }
        return $this->render('services/show.html.twig', [
            'services' => $services,
        ]);
    }
}
