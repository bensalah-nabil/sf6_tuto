<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //print table todo
        // si j'ai un tbaleau todo de todo je l'affiche
        if (!$session->has(name: 'todos')){
            $todos = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info', "The list in initilised");
        }
        // sinon je l'initialise

        return $this->render('todo/index.html.twig');
    }
    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')){
            //verif if I have a todo table in my session
            //if yes
            $todos = $session->get('todos');
            if (isset($todos[$name])){
                $this->addFlash('error', "The todo  $name is duplicated");
            }else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with id $name is added succefully");
            }
        } else {
            //if no
            //error and reidrect to index controller
            $this->addFlash('error', "The list is not initilised");
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')){
            //verif if I have a todo table in my session
            //if yes
            $todos = $session->get('todos');
            if (!isset($todos[$name])){
                $this->addFlash('error', "The todo  $name not found");
            }else{
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with id $name is deleted succefully");
            }
        } else {
            //if no
            //error and reidrect to index controller
            $this->addFlash('error', "The list is not initilised");
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse

    {
        $session = $request->getSession();
        $session->remove('todo');
        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')){
            //verif if I have a todo table in my session
            //if yes
            $todos = $session->get('todos');
            if (!isset($todos[$name])){
                $this->addFlash('error', "The todo  $name not found");
            }else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('success', "The todo with id $name is mofied succefully");
            }
        } else {
            //if no
            //error and reidrect to index controller
            $this->addFlash('error', "The list is not initilised");
        }
        return $this->redirectToRoute('todo');
    }

}
