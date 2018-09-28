<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Identity\Infrastructure\UUID;

class BookEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $book = new BookEntity();
        $this->assertSame(BookEntity::class, get_class($book));
    }

    public function testCreate()
    {
        $bookTitle = 'Test Title';
        $id = UUID::create();
        $book = BookEntity::create($id, $bookTitle);
        $this->assertSame(BookEntity::class, get_class($book));
        // Id
        $this->assertNotEmpty($book->id());
        $this->assertInternalType('string', $book->id());
        $this->assertStringMatchesFormat('%x-%x-4%x-%x-%x', $book->id());
        // Name
        $this->assertNotEmpty($book->title());
        $this->assertInternalType('string', $book->title());
        $this->assertSame($bookTitle, $book->title());
        // Created At
        $now = new \DateTime('now');
        $this->assertSame('DateTime', get_class($book->createdAt()));
        $this->assertEquals($now->getTimestamp(), $book->createdAt()->getTimestamp(), '', 10);
    }
}
