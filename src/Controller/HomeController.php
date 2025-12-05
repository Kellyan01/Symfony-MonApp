<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'result' => '',
        ]);
    }

    #[Route('/calculatrice/{nbr1}/{nbr2}/{string}', name: 'app_home_calculatrice')]
    public function calculatrice($nbr1, $nbr2, $string): Response
    {
        switch($string){
            case 'add' :
                $result = "L'Addition de $nbr1 et $nbr2 est égal au résultat : ".$nbr1 + $nbr2;
                break;
            case 'sous' :
                $result = "La Soustraction de $nbr1 par $nbr2 est égal au résultat : ".$nbr1 - $nbr2;
                break;
            case 'multi' :
                $result = "La Multiplication de $nbr1 et $nbr2 est égal au résultat : ".$nbr1 * $nbr2;
                break;
            case 'div' :
                if($nbr2 == 0){
                    $result = "On ne peut pas diviser par zéro !";
                }else{
                    $result = "La Division de $nbr1 par $nbr2 est égal au résultat : ".$nbr1 / $nbr2;
                }
                break;
            default :
                $result = "Opérateur Incorrect";
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'result' => $result,
        ]);
    }
}
