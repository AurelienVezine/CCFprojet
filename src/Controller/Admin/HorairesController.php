<?php

namespace App\Controller\Admin;

use App\Entity\Horaires;
use App\Form\HorairesType;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/horaire", name: "admin.horaire.")]
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
        return $this->render('admin/horaires/index.html.twig', [
            'groupedHoraires' => $groupedHoraires,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $horaires = new Horaires();
        $form = $this->createForm(HorairesType::class, $horaires);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($horaires);
            $em->flush();
            $this->addFlash('success', 'Votre horaire est bien créer');
            return $this->redirectToRoute('admin.horaire.index');
        }
        return $this->render('admin/horaires/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' =>Requirement::DIGITS])]
    public function edit(Request $request, Horaires $horaires, EntityManagerInterface $em)
    {
        $form = $this->createForm(HorairesType::class, $horaires);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre horaire est bien modifier');
            return $this->redirectToRoute('admin.horaire.index');
        }
        return $this->render('admin/horaires/edit.html.twig', [
            'horaires' => $horaires,
            'form' => $form,
        ]);
    }
}
