<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(MailerService $mailer, Request $request): Response
    {
        $form = $this->createFormBuilder()
        ->add('email', EmailType::class, ['label' => 'Votre adresse mail'])
        ->add('subject', TextType::class, ['label' => 'Votre sujet'])
        ->add('message', TextareaType::class, ['label' => 'Votre message', 'attr' => ['rows' => 10]])
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $mailer->sendMail(
                $form->get('email')->getData(),
                $form->get('subject')->getData(),
                $form->get('message')->getData()
            );
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}