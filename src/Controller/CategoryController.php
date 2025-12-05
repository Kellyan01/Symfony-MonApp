<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $category): Response
    {
        $categories = $category->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_detail')]
    public function indexDetail(CategoryRepository $category, $id): Response
    {
        $categorie = $category->find($id);

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categorie' => $categorie,
        ]);
    }
}
