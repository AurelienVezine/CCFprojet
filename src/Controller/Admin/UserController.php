<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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
    public function create(Request $request, EntityManagerInterface $em, MailerInterface $mailer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $mail = (new TemplatedEmail())
                ->to($user->getEmail())
                ->from('arcadia@zooarcadia.fr')
                ->subject('Bienvenue dans l\'entreprise ARCADIA')
                ->htmlTemplate('email/user.html.twig')
                ->context(['user' => $user]);
            $mailer->send($mail);
            $this->addFlash('success', 'Votre utilisateur est bien créer');
            return $this->redirectToRoute('admin.user.index');
        }
        return $this->render('admin/user/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Votre utilisateur est bien modifier');
            return $this->redirectToRoute('admin.user.index');
        }
        return $this->render('admin/user/edit.html.twig', [
            'users' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'],requirements: ['id' => Requirement::DIGITS])]
    public function delete(User $user, Request $request, EntityManagerInterface $em)
    {
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer un utilisateur avec le rôle ROLE_ADMIN');
            return $this->redirectToRoute('admin.user.index');
        }

            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'Votre utilisateur est bien supprimer');
            return $this->redirectToRoute('admin.user.index');
    }

}