<?php

namespace MyCompany\Book\Application;

use MyCompany\Book\DomainModel\BookNotFoundException;
use MyCompany\Book\DomainModel\BookRepository;
use MyCompany\Book\DomainModel\PriceValueObject;

class UpdateBookAction
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }
    /**
     * @param UpdateBookRequest $bookRequest
     * @throws BookNotFoundException
     */
    public function run(UpdateBookRequest $bookRequest)
    {
        try {

            $bookEntity =  $this->bookRepository->getById(
                $bookRequest->id()
            );
            $bookEntity->update(
                $bookRequest->title(),
                $bookRequest->author()
            );

            /** VALUE OBJECT EXAMPLE */

            $bookEntity->setPrice(new PriceValueObject(10, 'GBP'));

            /**
             * Case 1
             *
             * $bookEntity->price = 10;
             * $bookEntity->currency = 'GBP';
             *
             * Which one is better ?
             */

            /**
             * Case 2
             *
             * return true/false vs throw exception
             */

            $this->bookRepository->save($bookEntity);

        } catch (BookNotFoundException $exception){
            throw new BookNotFoundException('Book not found');
        }

    }
}
