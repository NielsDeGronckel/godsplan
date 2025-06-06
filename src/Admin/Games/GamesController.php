<?php

namespace App\Admin\Games;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GamesController extends AbstractController
{
    #[Route('/Games', name: 'games')]
    public function index(): Response
    {
        return $this->render('Games/Games.html.twig');
    }
}
