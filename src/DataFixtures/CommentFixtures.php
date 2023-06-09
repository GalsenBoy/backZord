<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Comment;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private PostRepository $postRepository
    ){}
    public function load(ObjectManager $manager): void
    {
        $comments = [];
      $faker = Factory::create('fr_FR');
      for ($i=0; $i < 13; $i++) { 
        $comment = new Comment();
        $comment->setComment($faker->paragraph);
        $manager->persist($comment);
        $comments[] = $comment;
      }
      $posts = $this->postRepository->findAll();
        foreach ($posts as $post) {
            $post->addComment(
                $comments[mt_rand(0,count($comments) -1)]
            );
        }
        $manager->flush();
    }
    public function getDependencies():array{
        return [PostFixtures::class];
    }
}
