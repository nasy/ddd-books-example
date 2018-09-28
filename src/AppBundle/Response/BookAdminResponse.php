<?php

namespace AppBundle\Response;

use MyCompany\Book\DomainModel\BookEntity;

class BookAdminResponse
{
    /** @var BookEntity */
    private $book;

    public function __construct(BookEntity $book)
    {
        $this->book = $book;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->book->id(),
            'title' => $this->book->title(),
            'author' => $this->book->author(),
        ];
    }
}
