<?php

namespace App\Controller\Admin;

use App\Entity\RapportVeterinaire;
use App\Form\RapportVeterinaireType;
use App\Repository\RapportVeterinaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/rapport", name: "admin.rapport.")]
class RapportController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(RapportVeterinaireRepository $rapportVeterinaireRepository): Response
    {
        $rapports = $rapportVeterinaireRepository->findAll();
        return $this->render('admin/rapport/index.html.twig', [
            'rapports' => $rapports,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $rapport = new RapportVeterinaire();
        $form = $this->createForm(RapportVeterinaireType::class, $rapport);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapport);
            $em->flush();
            $this->addFlash('success', 'Votre rapport est bien créer');
            return $this->redirectToRoute('admin.rapport.index');
        }
        return $this->render('admin/rapport/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(RapportVeterinaire $rapportVeterinaire, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(RapportVeterinaireType::class, $rapportVeterinaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre rapport est bien modifier');
            return $this->redirectToRoute('admin.rapport.index');
        }
        return $this->render('admin/rapport/edit.html.twig', [
            'rapports' => $rapportVeterinaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(RapportVeterinaire $rapportVeterinaire, Request $request, EntityManagerInterface $em)
    {
        $em->remove($rapportVeterinaire);
        $em->flush();
        $this->addFlash('success', 'Votre rapport est bien supprimer');
        return $this->redirectToRoute('admin.rapport.index');
    }

}