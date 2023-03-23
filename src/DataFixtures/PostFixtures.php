<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $user = $manager->getRepository(User::class)->findOneBy([]);

        for ($i=0; $i < 11 ; $i++) { 
            if ($user) {
                $post = new Post();
                $post->setArticle($faker->paragraph);
                $post->setUser($user);
                for ($j=0 ; $j<3; $j++) {
                    $comment = new Comment();
                    $comment->setComment($faker->paragraph);
                    $comment->setPost($post);
                    $manager->persist($comment);
                }
                $manager->persist($post);
            }
        }
        // dd($user);
        $manager->flush();
    }
}
