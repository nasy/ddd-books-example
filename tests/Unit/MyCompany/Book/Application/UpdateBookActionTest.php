<?php

namespace tests\Unit\MyCompany\Book\Command;

use MyCompany\Book\Application\UpdateBookAction;
use MyCompany\Book\Application\UpdateBookRequest;
use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UpdateBookActionTest extends WebTestCase
{
    public function testCommand()
    {
        $updateBookAction = new UpdateBookAction(
            new FakeBookRepository()
        );

        $updateBookAction->run(
            new UpdateBookRequest(
                new BookEntity(),
                'TITLE',
                'AUTHOR'
            )
        );
        // if exception is thrown never reaches the assert.
        static::assertTrue(true);
    }
}