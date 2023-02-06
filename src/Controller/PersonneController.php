<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/personne/add', name: 'app_personne')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $personne = new  Personne();
        $personne->setFirstname('Nabil');
        $personne->setName('Ben Salah');
        $personne->setAge(24);
        $personne->setAddress('Kebili');

        //Ajouter l'operation de la personne dans ma transaction
        $entityManager->persist($personne);

        //Execute this transaction Todo
        $entityManager->flush();
        return $this->render(' personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
}
