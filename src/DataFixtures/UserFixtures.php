<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 15; $i++) { 
            $user = new User();
            $user->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->safeEmail)
                ->setUserName($faker->userName)
                ->setPassword($faker->password);
            
            $numberOfPosts = $faker->numberBetween($min = 1, $max = 10);
            for ($j=0; $j < $numberOfPosts; $j++) { 
                $post = new Post();
                $post->setArticle($faker->paragraph)
                    ->setUser($user);
                $manager->persist($post);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }    
}
