<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailController extends AbstractController
{
    #[Route("/mail", name: "mail")]
    public function index(MailerService $mailer): Response
    {
        $mailer->sendMail(
            'destinataire@mail.com',
            'Hello Email',
            'Sending emails is fun again! (2)',
            '<p>See Twig integration for better HTML integration!</p>'
        );

        return $this->render('mail/index.html.twig', []);
    }
}