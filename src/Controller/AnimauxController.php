<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/animaux', name: 'animaux.')]
class AnimauxController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(AnimalRepository $animalRepository)
    {
        $animals = $animalRepository->findAll();
        return $this->render('animaux/index.html.twig', [
            'animals' => $animals,
        ]);

    }

    #[Route('/{id}-{prenom}', name: 'show', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function show(Request $request, AnimalRepository $animalRepository, int $id, string $prenom)
    {
        $animals = $animalRepository->find($id);
        if ($animals->getPrenom()!== $prenom) {
            return $this->redirectToRoute('animaux.show', ['prenom' => $prenom->getPrenom(), 'id' => $id], 301);
        }
        return $this->render('animaux/show.html.twig', [
            'animals' => $animals,
        ]);
    }

}
