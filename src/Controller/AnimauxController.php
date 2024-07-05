<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/animaux', name: 'animaux.')]
class AnimauxController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(Request $request, AnimalRepository $animalRepository)
    {
        $page = $request->query->getInt('page', 1);
        $animals = $animalRepository->paginateAnimals($page);
        return $this->render('animaux/index.html.twig', [
            'animals' => $animals,

        ]);

    }

    #[Route('/{id}-{prenom}', name: 'show', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function show(Request $request, AnimalRepository $animalRepository, int $id, string $prenom, EntityManagerInterface $em)
    {
        $animals = $animalRepository->find($id);
        $animals->setVueCount($animals->getVueCount() + 1);
        $em->flush();
        if ($animals->getPrenom()!== $prenom) {
            return $this->redirectToRoute('animaux.show', ['prenom' => $prenom->getPrenom(), 'id' => $id], 301);
        }
        return $this->render('animaux/show.html.twig', [
            'animals' => $animals,
        ]);
    }

}
