<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;


final class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $article): Response
    {
        //Récupérer tous les articles
        $articles = $article->findAll();

        //dd($articles);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=>$articles,
        ]);
    }

    #[Route('/article/{id}', name: 'app_article_detail')]
    public function article(ArticleRepository $article, $id): Response
    {

        //Récupérer un article selon son id
        $data = $article->find($id); 

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=>$data,
        ]);
    }

    #[Route('/article/titre/{title}', name: 'app_article_titre')]
    public function articleTitle(ArticleRepository $article, $title): Response
    {

        //Récupérer des articles selon un critère :
        // findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
        $data = $article->findBy(['title_article' => $title],[],10); 

        //Récupérer un seul article selon un critère
        // findOneBy(array $criteria, array $orderBy = null)
        //$data = $article->findOneBy(["name_cat" => $toto],[]); 

        dd($data);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=>$data,
        ]);
    }
}
