<?php

namespace MyCompany\Book\Application;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;
use MyCompany\Email\DomainModel\EmailObject;
use MyCompany\Email\DomainModel\EmailSenderService;

class CreateBookAction
{
    /** @var BookRepository */
    private $bookRepository;
    /** @var EmailSenderService */
    private $emailSenderService;

    public function __construct(
        BookRepository $bookRepository,
        EmailSenderService $emailSenderService,
    ) {
        $this->bookRepository = $bookRepository;
        $this->emailSenderService = $emailSenderService;
    }

    /**
     * @param CreateBookRequest $bookRequest
     * @return BookEntity
     */
    public function run(CreateBookRequest $bookRequest)
    {

        $bookEntity = BookEntity::create(
            $bookRequest->id(),
            $bookRequest->title(),
            $bookRequest->author()
        );

        /**
         * Case 1 PRIVATE PROPERTIES EXAMPLE
         *
         *  $bookEntity = new BookEntity();
         *  $bookEntity->title = $bookRequest->title();
         *  $bookEntity->author = $bookRequest->author();
         *
         * Which one is better/cleaner?
         */

        /**
         * Case 2 COUPLING EXAMPLE
         *
         *  Yii::app->bookRepository->save($bookEntity);
         *
         * Whats the problem here? What happens when we test this?
         */

        $this->bookRepository->save($bookEntity);

        $this->emailSenderService->send(
            new EmailObject(
                'Test subject',
                ['test@test.com']
            )
        );
        return $bookEntity;
    }
}
