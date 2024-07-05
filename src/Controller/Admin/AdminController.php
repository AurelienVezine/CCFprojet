<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Repository\AnimalRepository;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class AdminController extends AbstractController
{

    #[Route('/admin', name: 'admin.index')]
    public function index(Request $request, AvisRepository $avisRepository, EntityManagerInterface $em, AnimalRepository $animalRepository): Response
    {

        $avis = $avisRepository->findAll();
        $animal = $animalRepository->findMostViewedArray($request->query->getInt('page', 1));
        $animals = $animalRepository->findMostViewed();
        $names = array_map(function($animal) {
            return $animal->getPrenom();
        }, $animals);
        $viewCounts = array_map(function($animal) {
            return $animal->getVueCount();
        }, $animals);
        return $this->render('admin/admin.html.twig', [
            'avis' => $avis,
            'names' => $names,
            'viewCounts' => $viewCounts,
            'animals' => $animals,
            'animal' => $animal,
        ]);
    }
    #[Route('/{id}', name: 'admin.validate', methods: ['GET', 'POST'],requirements: ['id' => Requirement::DIGITS])]
    public function validate(Request $request, Avis $avis, EntityManagerInterface $em)
    {
        $avis ->setVisible(true);
        $em->flush();
        $this->addFlash('success', 'Votre avis est bien enregistrer');
        return $this->redirectToRoute('admin.index');
    }
    #[Route('/{id}', name: 'admin.delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(Request $request, Avis $avis, EntityManagerInterface $em)
    {
        $em->remove($avis);
        $em->flush();
        $this->addFlash('success', 'Votre avis est bien supprimer');
        return $this->redirectToRoute('admin.index');
    }
    #[Route('/show', name: 'admin.show')]
    public function list(Request $request, AvisRepository $avisRepository)
    {
        $avis = $avisRepository->findAll();
        return $this->render('admin/listAvis.html.twig', [
            'avis' => $avis,
        ]);
    }

}
