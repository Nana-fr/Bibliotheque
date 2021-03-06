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
        $books = $user->getBorrowings();
        
        return $this->render('user/infos.html.twig', [
            'user' => $user,
            'books' => $books
        ]);
    }
    #[Route('/user/add', name: 'user_add')]
    public function addUser(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('firstname', TextType::class, ['attr' => ['class' => 'form-control', 'label' => 'firstname']])
            ->add('lastname', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('street', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('city', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('postal_code', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('phone_number', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('email', TextType::class, ['required' => false, 'attr' => ['class' => 'form-control']])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
            ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user -> setRoles(['ROLE_USER']);
            $user -> setPassword('$2y$10$5Dloax2TwpgZQDEN3VB/f.Wiz1o0RvZmi1OO3n7Lebv.uYItc/jQW');
            $user -> setCardNumber(mt_Rand(100000,999999));
            $user -> setUsername($user -> getCardNumber());
            $user -> setRegistrationDate(date_create(date('Y-m-d')));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('users_listing');
        }
            return $this->renderForm('user/add.html.twig', [
                'form' => $form,
            ]); 
    }
}
