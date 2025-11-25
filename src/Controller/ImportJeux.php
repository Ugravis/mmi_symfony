<?php

namespace App\Controller;

use App\Entity\Game;
use App\Service\JsonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ImportJeux extends AbstractController
{
    #[Route('/import', name: 'app_import')]
    public function index(JsonService $jsonService, EntityManagerInterface $entityManager) : Response
    {
        $games = $jsonService->read('jeux.json');

        foreach ($games as $item) {
            $game = new game() ;

            $game->setName($item->jeu_nom);
            $game->setDuration($item->jeu_duree_partie);
            $game->setMini($item->jeu_nb_joueurs_mini);
            $game->setMax($item->jeu_nb_joueurs_maxi);
            $game->setPhoto1($item->jeu_photo1);
            $game->setPhoto2($item->jeu_photo2);
            $game->setPhoto3($item->jeu_photo3);
            $game->setPrice($item->jeu_prix_unit);
            $game->setStock($item->jeu_qte_stock);

            // $entityManager->persist($game);
        }

        // $entityManager->flush();

        return new Response('Importation réussie, ouvrez phpMyAdmin pour vérifier');    
    }
}