<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

        return new Response('ok');
    }


    /**
     * @Route("/todo/{name}", name="todo")
     */
    public function todo(String $name, Request $request)
    {
        /*$form = $this->createFormBuilder()
            ->add('username',TextType::class)
            ->add('mail',EmailType::class)
            ->add('password', PasswordType::class)
            ->getForm();*/

        $form = $this->createForm(TodoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $todoTmp = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoTmp);
            $em->flush();
        }

        return $this->render('udemy/todo.html.twig', [
            'name' => $name,
            'form' => $form->createView()
        ]);
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

    /**
     * @Route("/udemy/all", name="todo_all")
     */
    public function getAll()
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->findAll();
        for ($x=0; $x<count($todo); $x++){
            echo $todo[$x]->getName();
        }
        return new Response('tutti : ');
    }

    /**
     * @Route("/udemy/attrib", name="todo_attr")
     */
    public function getAttribute()
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->findBy(
            ['name' => 'Corso Udemy']
        );
        for ($x=0; $x<count($todo); $x++){
            echo $todo[$x]->getName();
        }
        return new Response('tutti : ');
    }

    /**
     * @Route("/udemy/attrib_pers", name="todo_attr_pers")
     */
    public function getAttributePers()
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->findByExampleField('ude');
        for ($x=0; $x<count($todo); $x++){
            echo $todo[$x]->getName();
        }
        return new Response('tutti : ');
    }

    /**
     * @Route("/updatetodo/{id}", name="update_todo")
     */
    public function updateTodo($id)
    {
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository(Todo::class)->find($id);
        if (!$todo){
            throw $this->createNotFoundException('Non trovato id: '.$id);
        }
        $todo->setPriority('medium')->setName('Udemy')->setStatus('ok');
        $em->flush();
        return new Response('trovato : '.$id);
    }

    /**
     * @Route("/deletetodo/{id}", name="delete_todo")
     */
    public function deleteTodo($id)
    {
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository(Todo::class)->find($id);
        if (!$todo){
            throw $this->createNotFoundException('Non trovato id: '.$id);
        }
        $em->remove($todo);
        $em->flush();
        return new Response('eliminato : '.$id);
    }
}
