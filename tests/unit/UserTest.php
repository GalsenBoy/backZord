<?php

namespace App\Tests;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $user = new User();
        $user->setFirstName('Bilaly')
            ->setLastName('Cissokho')
            ->setEmail('bilaly.cissokho@gmail.com')
            ->setPassword('xsoqsa#/.§')
            ->setUserName('GalsenBoy')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setSeniority('depuis 2 jours');

        $errors = $container->get('validator')->validate($user);
        $this->assertCount(0,$errors);
    }
}
