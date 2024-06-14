<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/user", name: "admin.user.")]
class UserController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre utilisateur est bien créer');
            return $this->redirectToRoute('admin.user.index');
        }
        return $this->render('admin/user/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(UserRepository $userRepository, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class, $userRepository);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre utilisateur est bien modifier');
            return $this->redirectToRoute('admin.user.index');
        }
        return $this->render('admin/user/edit.html.twig', [
            'users' => $userRepository,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(UserRepository $userRepository, Request $request, EntityManagerInterface $em)
    {
        $em->remove($userRepository);
        $em->flush();
        $this->addFlash('success', 'Votre utilisateur est bien supprimer');
        return $this->redirectToRoute('admin.user.index');
    }

}