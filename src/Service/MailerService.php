<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
  public function __construct(private MailerInterface $mailer) {}

  public function sendMail(
    string $destinataire,
    string $subject,
    string $textMessage,
    ?string $htmlMessage = null
  )
  {
    if (!$htmlMessage) {
      $htmlMessage = $textMessage;
    }

    $email = (new Email())
      ->from('mail@mail.com')
      ->to($destinataire)
      ->subject($subject)
      ->text($textMessage)
      ->html($htmlMessage);

    $this->mailer->send($email);
  }
}