<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;
use MyCompany\Identity\Infrastructure\UUID;

class BookRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $class = new FakeBookRepository();
        $this->assertInstanceOf(BookRepository::class, $class);
    }

    public function testGetById()
    {
        $repository = new FakeBookRepository();
        $book = $repository->getById(UUID::createFromID(1));
        $this->assertInstanceOf(BookEntity::class, $book);
    }

    public function testSave()
    {
        $repository = new FakeBookRepository();
        $book = $repository->save(new BookEntity());
        $this->assertInstanceOf(BookEntity::class, $book);
    }

    // TODO rest
}
