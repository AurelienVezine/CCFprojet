<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use App\Form\HabitatType;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/habitat", name: "admin.habitat.")]
class HabitatController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();
        return $this->render('admin/habitat/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $habitat = new Habitat();
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($habitat);
            $em->flush();
            $this->addFlash('success', 'Votre habitat est bien créer');
            return $this->redirectToRoute('admin.habitat.index');
        }
        return $this->render('admin/habitat/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Habitat $habitat, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre habitat est bien modifier');
            return $this->redirectToRoute('admin.habitat.index');
        }
        return $this->render('admin/habitat/edit.html.twig', [
            'habitat' => $habitat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(Habitat $habitat, Request $request, EntityManagerInterface $em)
    {
        $em->remove($habitat);
        $em->flush();
        $this->addFlash('success', 'Votre habitat est bien supprimer');
        return $this->redirectToRoute('admin.habitat.index');
    }

}
