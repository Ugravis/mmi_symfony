<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/jeu/new', name: 'app_game_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectToRoute('app_games');
        }

        return $this->render('game/new.html.twig', [
            'game_form' => $form->createView()
        ]);
    }

    #[Route('/jeu/{id}/edit', name: 'app_game_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if (!$game) {
            throw $this->createNotFoundException("Ce jeu n'existe pas");
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectToRoute('app_fiche', ['id' => $game->getId()]);
        }

        return $this->render('game/edit.html.twig', [
            'game_form' => $form->createView(),
            'game' => $game,
            'id' => $id
        ]);
    }
}