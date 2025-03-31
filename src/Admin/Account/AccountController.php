<?php

namespace App\Admin\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/Account', name: 'account')]
    public function index(): Response
    {
        return $this->render('Account/Account.html.twig');
    }
}
