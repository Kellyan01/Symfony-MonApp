<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $user): Response
    {
        //Je récupère tous mes utilisateurs
        $users = $user->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'toto' => $users,
        ]);
    }

    #[Route('/user/{email}', name: 'app_user_email')]
    public function indexEmail(UserRepository $user, $email): Response
    {
        //Je récupère un utilisateur selon son mail
        $users = $user->findOneBy([ 'email_user' => $email]);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'objectUser' => $users,
        ]);
    }
}
