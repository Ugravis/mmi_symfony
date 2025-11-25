<?php

namespace App\Controller;

use App\Form\GameType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/jeu/new', name: 'app_game')]
    public function index(): Response
    {
        $form = $this->createForm(GameType::class);

        return $this->render('game/index.html.twig', [
            'game_form' => $form->createView()
        ]);
    }
}