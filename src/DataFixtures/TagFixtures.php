<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Repository\PostRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private PostRepository $postRepository
    ){}
    public function load(ObjectManager $manager): void
    {
        $tags = [];
        $faker = Factory::create('fr_FR');
        for ($i=0; $i <7; $i++) { 
            $tag = new Tag();
            $tag->setName($faker->word);
            $manager->persist($tag);
            $tags[] = $tag;
        }
        $posts = $this->postRepository->findAll();
        foreach ($posts as $post) {
            $post->addTag(
                $tags[mt_rand(0,count($tags) -1)]
            );
        }
        $manager->flush();
    }

    public function getDependencies():array{
        return [PostFixtures::class];
    }
}
