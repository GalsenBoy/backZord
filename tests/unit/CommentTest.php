<?php

namespace App\Tests;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    public function testSomething(): void
    {
       self::bootKernel();

      $container = static::getContainer();
      $comment = new Comment();
      $comment->setComment('Commentaire #1')
        ->setCreatedAt(new \DateTimeImmutable())
        ->setFromNow('depuis 3 jours');

    $errors = $container->get('validator')->validate($comment);

    $this->assertCount(0,$errors);
    }
}
