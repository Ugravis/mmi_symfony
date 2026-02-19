<?php

namespace App\Controller;

use App\Repository\EditorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(EditorRepository $editorRepository): Response
    {
        $editors = $editorRepository->testEditor('33000');

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'editors' => $editors
        ]);
    }
}
