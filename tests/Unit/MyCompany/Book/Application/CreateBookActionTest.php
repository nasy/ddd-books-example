<?php

namespace tests\Unit\MyCompany\Book\Command;

use MyCompany\Book\Application\CreateBookAction;
use MyCompany\Book\Application\CreateBookRequest;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;
use MyCompany\Email\Infrastructure\Fake\FakeSendEmailService;
use MyCompany\Identity\Infrastructure\UUID;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateBookCommandHandlerTest extends WebTestCase
{
    public function testCommand()
    {
        $createBookAction = new CreateBookAction(
            new FakeBookRepository(),
            new FakeSendEmailService(),
            new FakeMarketingApi()
        );

        $createBookAction->run(
            new CreateBookRequest(
                UUID::create(),
                'TITLE',
                'AUTHOR'
            )
        );
        // if exception is thrown never reaches the assert.
        static::assertTrue(true);
    }
}