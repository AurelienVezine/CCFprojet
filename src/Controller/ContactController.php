<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request,MailerInterface $mailer): Response
    {

        $data = new ContactDTO();
        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mail = (new TemplatedEmail())
                ->to('arcadia@myprojet.fr')
                ->from($data->email)
                ->subject($data->title)
                ->htmlTemplate('email/contact.html.twig')
                ->context(['data' => $data]);
            $mailer->send($mail);
            $this->addFlash('success','Votre email est bien envoyé');
            return $this->redirectToRoute('contact');


        }

        return $this->render('contact/contact.html.twig', [
            'form'=> $form
        ]);
    }
}
