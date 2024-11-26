<?php

namespace App\Controller\Api;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted(new Expression('is_granted("ROLE_EMPLOYER")'))]
class ChartJsController extends AbstractController
{
    #[Route('/api/chartjs', name: 'api_chartjs', methods:['get'] )]
    public function index(Request $request, AvisRepository $avisRepository, EntityManagerInterface $em, AnimalRepository $animalRepository): JsonResponse
    {
        $animals = $animalRepository->findMostViewed();

        $names = array_map(function($animal) {
            return $animal->getPrenom();
        }, $animals);
        $viewCounts = array_map(function($animal) {
            return $animal->getVueCount();
        }, $animals);

        $data = [];

        $data[] = [
            'names' => $names,
            'viewCounts' => $viewCounts,
        ];

        return $this->json($data);
    }
}

