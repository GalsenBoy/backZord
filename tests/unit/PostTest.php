<?php

namespace App\Tests;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $post = new Post();
        $post->setArticle('article #1')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setFromNow('il y\'a 2h')
            ->setUpdatedAt(new \DateTimeImmutable());

        $errors = $container->get('validator')->validate($post);
            // ->setUser();

        $this->assertCount(0,$errors);
        
        // $this->assertSame('test', $kernel->getEnvironment());
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
