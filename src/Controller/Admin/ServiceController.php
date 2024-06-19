<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use App\Form\ServiceType;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/service", name: "admin.service.")]
class ServiceController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findAll();
        return $this->render('admin/service/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $service = new Services();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($service);
            $em->flush();
            $this->addFlash('success', 'Votre service est bien créer');
            return $this->redirectToRoute('admin.service.index');
        }
        return $this->render('admin/service/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Services $services, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ServiceType::class, $services);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre service est bien modifier');
            return $this->redirectToRoute('admin.service.index');
        }
        return $this->render('admin/service/edit.html.twig', [
            'services' => $services,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(Services $services, Request $request, EntityManagerInterface $em)
    {
        $em->remove($services);
        $em->flush();
        $this->addFlash('success', 'Votre service est bien supprimer');
        return $this->redirectToRoute('admin.service.index');
    }

}