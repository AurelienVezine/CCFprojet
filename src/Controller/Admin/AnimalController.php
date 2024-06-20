<?php

namespace App\Controller\Admin;


use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;


#[Route("/admin/animal", name: "admin.animal.")]
class AnimalController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(AnimalRepository $animalRepository)
    {
        $animals = $animalRepository->findAll();
        return $this->render('admin/animal/index.html.twig', [
            'animals' => $animals,
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
    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Request $request, Animal $animal, EntityManagerInterface $em)
    {
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  UploadedFile $file */
            $file = $form->get('thumbnailFile')->getData();
            $filename = $animal->getId() . '.' . $file->getClientOriginalExtension();
            $file ->move('???',$filename);
            $animal->setThumbnail($filename);
            $em->flush();
            $this->addFlash('success', 'Votre animal est bien modifier');
            return $this->redirectToRoute('admin.animal.index');
        }
        return $this->render('admin/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(Request $request, Animal $animal, EntityManagerInterface $em)
    {
        $em->remove($animal);
        $em->flush();
        $this->addFlash('success', 'Votre animal est bien supprimer');
        return $this->redirectToRoute('admin.animal.index');
    }
}