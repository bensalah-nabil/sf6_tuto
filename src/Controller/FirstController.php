<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first/Nabil', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'Ben Salah',
            'firstname' => 'Nabil',
        ]);
    }

    #[Route('/sayHello/{name}', name: 'say_hello')]
    public function sayHello($name): Response
    {
        return $this->render('first/hello.html.twig',['nom' => $name]);
    }
}
