<?php

namespace App\Controller\Admin;

use App\Entity\Race;
use App\Form\RaceType;
use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/race", name: "admin.race.")]
class RaceController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(RaceRepository $raceRepository): Response
    {
        $races = $raceRepository->findAll();
        return $this->render('admin/race/index.html.twig', [
            '$races' => $races,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $race = new Race();
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($race);
            $em->flush();
            $this->addFlash('success', 'Votre race est bien créer');
            return $this->redirectToRoute('admin.race.index');
        }
        return $this->render('admin/race/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Race $race, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre race est bien modifier');
            return $this->redirectToRoute('admin.race.index');
        }
        return $this->render('admin/race/edit.html.twig', [
            'race' => $race,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(Race $race, Request $request, EntityManagerInterface $em)
    {
        $em->remove($race);
        $em->flush();
        $this->addFlash('success', 'Votre race est bien supprimer');
        return $this->redirectToRoute('admin.race.index');
    }

}
