<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $post = $manager->getRepository(Post::class)->findOneBy([]);
        for ($i=0; $i < 11 ; $i++) { 
            if($post != null){
                $comment = new Comment();
                $comment->setComment($faker->paragraph);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }
        // dd($user);
        $manager->flush();
    }
}
