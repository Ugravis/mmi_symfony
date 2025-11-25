<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Service\UploadPhotoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/jeu/new', name: 'app_game_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, UploadPhotoService $uploadPhotoService): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadPhotoService->setFileRepository($this->getParameter('kernel.project_dir') . '/public/images/jeux');
            $photo1 = $form->get('photo1')->getData();
            $photo2 = $form->get('photo2')->getData();
            $photo3 = $form->get('photo3')->getData();
            
            if ($photo1) {
                $photo1Name = $uploadPhotoService->upload($photo1);
                $game->setPhoto1($photo1Name);
            }
            if ($photo2) {
                $photo2Name = $uploadPhotoService->upload($photo2);
                $game->setPhoto2($photo2Name);
            }
            if ($photo3) {
                $photo3Name = $uploadPhotoService->upload($photo3);
                $game->setPhoto3($photo3Name);
            }

            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectToRoute('app_games');
        }

        return $this->render('game/new.html.twig', [
            'game_form' => $form->createView(),
            'game' => $game
        ]);
    }

    #[Route('/jeu/{id}/edit', name: 'app_game_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager, UploadPhotoService $uploadPhotoService): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if (!$game) {
            throw $this->createNotFoundException("Ce jeu n'existe pas");
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadPhotoService->setFileRepository($this->getParameter('kernel.project_dir') . '/public/images/jeux');
            $photo1 = $form->get('photo1')->getData();
            $photo2 = $form->get('photo2')->getData();
            $photo3 = $form->get('photo3')->getData();
            
            if ($photo1) {
                $photo1Name = $uploadPhotoService->upload($photo1);
                $game->setPhoto1($photo1Name);
            }
            if ($photo2) {
                $photo2Name = $uploadPhotoService->upload($photo2);
                $game->setPhoto2($photo2Name);
            }
            if ($photo3) {
                $photo3Name = $uploadPhotoService->upload($photo3);
                $game->setPhoto3($photo3Name);
            }

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

    #[Route(path: '/jeu/{id}/delete', name: 'app_game_delete', requirements: ['id' => '\d+'])]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);

        if (!$game) {
            throw $this->createNotFoundException("Ce jeu n'existe pas");
        }

        $entityManager->remove($game);
        $entityManager->flush();

        return $this->redirectToRoute('app_games');
    }
}