<?php

namespace AppBundle\DataFixtures\ORM\Book;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use MyCompany\Identity\Infrastructure\UUID;

use MyCompany\Book\DomainModel\BookEntity;

class BookData extends AbstractFixture implements OrderedFixtureInterface
{
    static public $books = [];
    public function load(ObjectManager $manager)
    {
    $bookOne = BookEntity::create(UUID::create(), 'Test book 1', 'Test author 1');
    $manager->persist($bookOne);

    $bookTwo = BookEntity::create(UUID::create(), 'Test book 2', 'Test author 2');
    $manager->persist($bookTwo);

    $manager->flush();
    self::$books[] = $bookOne;
    self::$books[] = $bookTwo;

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}