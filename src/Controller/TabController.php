<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'app_tab')]
    public function index($nb): Response
    {
        $notes = [];
        for ($i = 0;$i<$nb ; $i++){
             $notes[] = rand(0,20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }
    #[Route('/tab/users', name:'users_tab')]
    public function users(): Response{
        $users = [
            ['firstname' => 'nabil','name' =>'ben salah','age'=> 24],
            ['firstname' => 'aymen','name' =>'sellaouti','age'=> 39],
            ['firstname' => 'ali','name' =>'ben ali','age'=> 50],
        ];
        return $this->render('tab/users.html.twig', [
            'users'=>$users,
        ]);
    }
}
