<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/users/listing', name: 'users_listing')]
    public function getUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        return $this->render('user/listing.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/infos/{id}', name: 'user_infos')]
    public function getOneUser(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        //  dump($user->getBooks());
        // dd($user);
        return $this->render('user/infos.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/user/add', name: 'user_add')]
    public function addUser(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        // creates a book object and initializes some data for this example
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('firstname', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('lastname', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('street', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('city', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('postal_code', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('phone_number', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('email', TextType::class, ['attr' => ['required' => false, 'class' => 'form-control']])
            
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
            ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            $user -> setRoles(['ROLE_USER']);
            $user -> setPassword('$2y$10$5Dloax2TwpgZQDEN3VB/f.Wiz1o0RvZmi1OO3n7Lebv.uYItc/jQW');
            $user -> setCardNumber(mt_Rand(100000,999999));
            $user -> setUsername($user -> getCardNumber());
            $user -> setRegistrationDate(date_create(date('Y-m-d')));

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('users_listing');
        }


            return $this->renderForm('user/add.html.twig', [
                'form' => $form,
            ]); 
            
    }
}
