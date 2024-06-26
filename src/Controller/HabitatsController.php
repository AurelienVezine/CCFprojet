<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
#[Route('/habitats', name: 'habitats.')]
class HabitatsController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(HabitatRepository $habitatRepository)
    {
        $habitats = $habitatRepository->findAll();
        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats,
        ]);

    }
    #[Route('/{id}-{nom}', name: 'show', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function show(Request $request, HabitatRepository $habitatRepository, int $id, string $nom)
    {
        $habitats = $habitatRepository->find($id);
        if ($habitats->getNom()!== $nom) {
            return $this->redirectToRoute('animaux.show', ['nom' => $nom->getNom(), 'id' => $id], 301);
        }
        return $this->render('habitats/show.html.twig', [
            'habitats' => $habitats,
        ]);
    }
}
