<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'tab' => ['Premier','Second']
        ]);
    }

    #[Route('/accueil/{name}', name: 'app_accueil_name')]
    public function index2($name): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            "name" => $name,
        ]);
    }

    #[Route('/accueil/{nbr1}/{nbr2}', name: 'app_accueil_addition')]
    public function addition($nbr1, $nbr2):Response{
        if($nbr1 < 0 && $nbr2 < 0){
            $result = "les nombres sont négatifs";
        }else{
            
            $result = "L'addition de $nbr1 et $nbr2 est égale au résultat : ".$nbr1 + $nbr2;  
        }
        

        return $this->render('accueil/index.html.twig',[
            'controller_name' => 'AccueilController',
            'result' => $result,
        ]);
    }
}
