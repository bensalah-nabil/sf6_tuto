<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();
        if ($session->has('AccessNb')){
            $AccessNumber = $session->get('AccessNb') + 1;

        }else{
            $AccessNumber = 1;
        }
        $session->set('AccessNb',$AccessNumber);
        return $this->render('session/index.html.twig');
    }
}
