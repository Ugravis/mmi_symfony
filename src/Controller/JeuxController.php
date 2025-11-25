<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuxController extends AbstractController
{
    #[Route(
        '/jeux', 
        name: 'app_games'
    )]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();
        // dd($games);

        return $this->render('jeux/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route(
        '/fiche/{id}', 
        name: 'app_fiche', 
        defaults: ['id' => 1], 
        requirements: ['id'=>'\d+']
    )]
    public function fiche(GameRepository $gameRepository, int $id): Response
    {
        $game = $gameRepository->find($id);

        return $this->render('jeux/fiche.html.twig', [
            'game' => $game
        ]);
    }
}