<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
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
}
