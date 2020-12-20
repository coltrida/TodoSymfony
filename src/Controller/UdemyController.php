<?php

namespace App\Controller;

use App\Entity\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UdemyController extends AbstractController
{
    /**
     * @Route("/", name="udemy")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $todo = new Todo();
        $todo->setName("Terzo Corso")
            ->setPriority("bassa")
            ->setStatus('on going')
            ->setDateCreation(new \DateTime());

        $em->persist($todo);
        $em->flush();

        return $this->render('udemy/index.html.twig', [
            'controller_name' => 'UdemyController',
        ]);
    }


    /**
     * @Route("/todo", name="todo")
     */
    public function todo()
    {
        return $this->render('udemy/todo.html.twig');
    }

    /**
     * @Route("/udemy/details", name="todo_details")
     */
    public function getDetails()
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find(1);
        if (!$todo){
            throw $this->createNotFoundException('Non trovato');
        }
        return new Response('il nome è: '.$todo->getName());
    }
}
