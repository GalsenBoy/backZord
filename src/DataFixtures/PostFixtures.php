<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 6; $i++) { 
            $post = new Post();
            $post->setArticle($faker->paragraph);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
