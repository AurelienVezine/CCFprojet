<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    #[Route('/{id}', name: 'show', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function show(Habitat $habitat, AnimalRepository $animalRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $animals = $animalRepository->findByHabitat($request->query->getInt('page', 1), $habitat);

        return $this->render('habitats/show.html.twig', [
            'habitats' => $habitat,
            'animals' => $animals,
        ]);
    }
    /*public function show(Request $request, HabitatRepository $habitatRepository, int $id, AnimalRepository $animal)
    {
       $habitats = $habitatRepository->find($id);
        $page = $request->query->getInt('page', 1);
        $animals = $animal->paginateAnimalsHabitat($page);
        return $this->render('habitats/show.html.twig', [
            'habitats' => $habitats,
            'animals' => $animals,
        ]);

    }*/
}
