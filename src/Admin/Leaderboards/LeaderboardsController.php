<?php

namespace App\Admin\Leaderboards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeaderboardsController extends AbstractController
{
    #[Route('/Leaderboards', name: 'leaderboards')]
    public function index(): Response
    {
        return $this->render('Leaderboards/Leaderboards.html.twig');
    }
}
