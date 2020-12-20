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
        $todo->setName("Corso Udemy")
            ->setPriority("alta")
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
}
