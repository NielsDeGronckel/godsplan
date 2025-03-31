<?php

namespace App\Admin\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/Contact', name: 'contact')]
    public function index(): Response
    {
        return $this->render('Contact/Contact.html.twig');
    }
}
