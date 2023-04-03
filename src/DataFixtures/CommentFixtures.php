<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        
        $faker = Factory::create('fr_FR');
        $user = new User();
        $user->setFirstName($faker->firstName);
        $user->setLastName($faker->lastName);
        $user->setEmail($faker->safeEmail);
        $user->setUserName($faker->userName);
        $user->setPassword($faker->password);
        $manager->persist($user);
        $post = new Post();
        $post->setArticle('Articles test')
            ->setUser($user);
        $manager->persist($post);
       
        for ($i=0; $i < 11 ; $i++) { 
            $comment = new Comment();
            $comment->setComment($faker->paragraph);
            $comment->setPost($post);
            $manager->persist($comment);
        }
        // dd($user);
        $manager->flush();
    }
}
