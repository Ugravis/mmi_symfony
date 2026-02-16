<?php

  namespace App\Event;

  use App\Entity\User;
  use Symfony\Contracts\EventDispatcher\Event;

  class UserRegisteredEvent extends Event
  {
      const NAME = 'user.registered';

      private $user;

      public function __construct(User $user)
      {
          $this->user = $user;
      }

      public function getUser()
      {
        dd($this->user);
        return $this->user;
      }
  }