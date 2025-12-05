<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Mise en place de Faker
        $faker = Faker\Factory::create("fr_FR");

        $users = [];
        // Création de 100 utilisateur à la main
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
                $user->setNameUser($faker->lastName())
                        ->setFirstnameUser($faker->firstName())
                        ->setEmailUser($faker->email())
                        ->setPasswordUser($faker->password())
                        ->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d H:i:s')));

            $users[] = $user;
            //Persistance de l'utilisateur
            $manager->persist($user);
        }

        $categories=[];
        // Création de la Category
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
                $category->setNameCat($faker->word())
                        ->setDescriptionCat($faker->sentence());
            $categories[] = $category;
            //Persistance de la catégorie
            $manager->persist($category);
        }
        

        // Création d'un Article
        for ($i = 0; $i < 100; $i++) {
            $article = new Article();
            $article->setTitleArticle($faker->sentence())
                    ->setContentArticle($faker->paragraphs(1,true))
                    ->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d H:i:s')))
                    ->setImageArticle($faker->imageUrl(640, 480, 'articles', true))
                    ->setWriteBy($faker->randomElement($users)) // Assigner un utilisateur aléatoire comme auteur en le cherchant dans le tableau $users
                    ->addCategory($faker->randomElement($categories));

            // Faire perister les objets dans la base de données
            $manager->persist($article);
        }

        $manager->flush();
    }
}
