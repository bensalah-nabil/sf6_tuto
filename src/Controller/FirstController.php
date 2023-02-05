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
    #[Route(
        'multi/{int1}/{int2}',
        name: 'app_first_multiplication',
        requirements:['int1' => '\d+','int2' => '\d+']
    )]
    public function multiplication($int1, $int2){
        $resultat = $int1 * $int2;
        return new Response("<h1> $resultat </h1>");
    }
    #[Route('/order/{myVar}',name: 'test_order_route')]
    public function testOrderRoute($myVar){
        return new Response(
            "<html><body>$myVar</body></html>"
        );
    }
}
