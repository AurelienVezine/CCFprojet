<?php

namespace App\Controller;

use App\Document\testmongodb;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MangoController extends AbstractController
{
    #[Route('/liste-zoo', name: 'liste-zoo', methods: ['GET'])]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
        ->getDocumentCollection(testmongodb::class)
        ->find();

        return $this->render('zoo/index.html.twig', [
            'cursor' => $cursor->toArray(),
            ]);
    }
}
