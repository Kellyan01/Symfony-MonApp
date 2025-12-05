<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;


final class ArticleController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){}

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

    #[Route('/create/article', name: 'app_article_create', methods:['GET', 'POST'])]
    public function createArticle(Request $request){
        //Création d'un objet Article
        $article = new Article();

        //Création du formulaire d'ajout d'article
        $form = $this->createForm(ArticleType::class,$article);

        //Récupérer les données du formulaire via l'objet request
        $form->handleRequest($request);

        //Vérifier qu'on reçoit un formulaire + vérifier qu'il est valide
        if($form->isSubmitted() && $form->isValid()){
            //Afficher le contenu de mon objet (dump and die)
            //dd($article);

            //Persister mon objet article
            $this->em->persist($article);

            //Flush de mon article
            $this->em->flush();

            //Redirection vers la même route pour faire un reset du formulaire
            return $this->redirectToRoute('app_article_create',['message' => 'enregistrement effectué']);
        }

        // $message='';
        // if(isset($_GET['message']) && !empty($_GET['message'])){
        //     $message = $_GET['message'];
        // };

        //Affichage du formulaire en le passant à Twig
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'totoForm' => $form,
            'message' => $request->query->get('message')
        ]);
    }
}
