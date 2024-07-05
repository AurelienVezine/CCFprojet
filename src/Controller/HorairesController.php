<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/horaires', name: 'horaires.')]
class HorairesController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(HorairesRepository $horairesRepository): Response
    {
        $horaires = $horairesRepository->findAll();
        $groupedHoraires = [];
        foreach($horaires as $horaire) {
            $groupedHoraires[$horaire->getServicename()][$horaire->getDay()][] = $horaire;
        }
        return $this->render('horaires/index.html.twig', [
            'groupedHoraires' => $groupedHoraires,
        ]);
    }
}
