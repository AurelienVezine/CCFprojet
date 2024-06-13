<?php

namespace App\Controller\Admin;


use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[route("/admin/animal", name: "admin.animal.")]
class AnimalController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(AnimalRepository $animalRepository)
    {
        return $this->render('admin/animal/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }


    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($animal);
            $em->flush();
            $this->addFlash('success', 'Votre animal est bien créer');
            return $this->redirectToRoute('admin.animal.index');
        }
        return $this->render('admin/animal/create.html.twig', [
            'form' => $form
        ]);


    }

}