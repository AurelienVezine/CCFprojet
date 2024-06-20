<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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
}
