<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
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
    #[Route('/all/{page?1}/{nber?12}',name: 'personne.list.all')]
    public function indexAll(ManagerRegistry $doctrine, $page, $nber) : Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $nbPersonne = $repository->count([]);
        $nbPage = ceil($nbPersonne / $nber );

        $personnes = $repository->findBy([],[],limit: $nber,offset: ( $page - 1 ) * $nber);

        return $this->render('personne/index.html.twig',
            [
                'personnes'=>$personnes,
                'isPaginated' => True,
                'nbPage' => $nbPage,
                'page' =>$page,
                'nber' => $nber,
            ]);
    }

    #[Route('/{id<\d+>}',name: 'personne.detail')]
    public function detail(Personne $personne = null) : Response
    {
        if (!$personne){
            $this->addFlash('error',"Doesn't exist");
            return $this->redirectToRoute('personne.list');
        }
        return $this->render('personne/detail.html.twig',
            ['personne'=>$personne]);
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
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
}