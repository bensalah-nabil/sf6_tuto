<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Faker\Guesser\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonneController extends AbstractController
{
    #[Route('/',name: 'personne.list')]
    public function index(ManagerRegistry $doctrine) : Response
    {
       $repository = $doctrine->getRepository(Personne::class);
       $personnes = $repository->findAll();
       return $this->render('personne/index.html.twig',
           ['personnes'=>$personnes]);
    }
    #[Route('/add', name: 'personne.add')]
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
