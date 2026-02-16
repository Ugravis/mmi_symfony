<?php

namespace App\EventSubscriber;

use App\Event\UserRegisteredEvent;
use App\Service\MailerService;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class UserRegisteredSubscriber implements EventSubscriberInterface
{
  public function getSubscribedEvents()
  {
    return [
      UserRegisteredEvent::NAME => 'onUserRegistered',
    ];
  }

  public function onUserRegistered(UserRegisteredEvent $event, MailerService $mailerService)
  {
    $mailerService->sendMail(
      $event->getUser()->getEmail(),
      "Test new user: ".$event->getUser()->getName(),
      "Text text text"
    );
  }
}