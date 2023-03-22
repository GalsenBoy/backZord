<?php

use Faker\Factory;
use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 10 ; $i++) { 
            $post = new Post();
            $post->setArticle($faker->paragraph);
            for ($j=0; $j < 3; $j++) { 
                $comment = new Comment();
                $comment->setComment($faker->paragraph);
                $comment->setPost($post);
                $manager->persist($comment);
            }
            $manager->persist($post);
        }
        // dd($post);
        $manager->flush();
    }
}