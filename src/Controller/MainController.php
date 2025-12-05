<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'Mon App',
            'idTwig' => "Pas d'Id",
        ]);
    }
    
    #[Route('/main/{id}', name: 'app_main_id')]
    public function mainRoute($id): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'MA ROUTE YALM',
            'idTwig' => $id,
        ]);
    }
}
