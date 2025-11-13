<?php

namespace App\Controller;

use App\Service\JsonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuxController extends AbstractController
{
    #[Route(
        '/jeux', 
        name: 'app_jeux'
    )]
    public function index(JsonService $jsonService): Response
    {
        $jeux = $jsonService->read("jeux.json");
        // dd($jeux);

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route(
        '/jeux/{code}', 
        name: 'app_fiche', 
        defaults: ['code' => 1], 
        requirements: ['code'=>'\d+']
    )]
    public function fiche(JsonService $jsonService, int $code): Response
    {
        $jeux = $jsonService->read("jeux.json");

        return $this->render('jeux/fiche.html.twig', [
            'jeux' => $jeux,
            'code' => $code
        ]);
    }
}
