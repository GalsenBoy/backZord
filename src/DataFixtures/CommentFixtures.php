<?php

// src/DataFixtures/CommentFixtures.php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $post = $manager->getRepository(Post::class)->findOneBy([]);

        if ($post !== null) {
            for ($i=0; $i < 3; $i++) { 
                $comment = new Comment();
                $comment->setComment($faker->paragraph);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        $manager->flush();
        } else {
            echo "Pas de posts dans la base de données!";
        }
    }
}
