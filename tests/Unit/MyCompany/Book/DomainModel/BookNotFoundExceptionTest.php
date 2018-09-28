<?php

namespace tests\Unit\MyCompany\Book\DomainModel;

use MyCompany\Book\DomainModel\BookNotFoundException;

class BookNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $exception = new BookNotFoundException();
        $this->assertSame(BookNotFoundException::class, get_class($exception));
    }
}