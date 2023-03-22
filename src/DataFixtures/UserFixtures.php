<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 15 ; $i++) { 
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->safeEmail);
            $user->setUserName($faker->userName);
            $user->setPassword($faker->password);
            for ($j=0; $j < 5 ; $j++) { 
                $post = new Post();
                $post->setArticle($faker->paragraph);
                $post->setUser($user); 
                $manager->persist($post);
            }
            $manager->persist($user);
        }
        // dd($user);
        $manager->flush();
    }
}
