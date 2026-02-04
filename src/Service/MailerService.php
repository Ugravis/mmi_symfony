<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
  public function __construct(private MailerInterface $mailer) {}

  public function sendMail()
  {
    $email = (new Email())
      ->from('mail@mail.com')
      ->to('destinataire@mail.com')
      ->subject('Hello Email')
      ->text('Sending emails is fun again!')
      ->html('<p>See Twig integration for better HTML integration!</p>');

    $this->mailer->send($email);
  }
}