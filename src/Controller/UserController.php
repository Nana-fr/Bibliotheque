<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
