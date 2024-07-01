<?php

namespace App\Controller;



use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, AvisRepository $avisRepository, EntityManagerInterface $em): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($avis);
            $em->flush();
            $this->addFlash('success', 'Votre avis est bien prise en compte !');
            return $this->redirectToRoute('home');
        }

        $page = $request->query->getInt('page', 1);
        $avis = $avisRepository->paginateAvis($page);
        return $this->render('home/index.html.twig', [
            'avis' => $avis,
            'form' => $form,
        ]);

    }
}
