<?php

namespace MyCompany\Book\Infrastructure\Persistance\Fake;

use MyCompany\Book\DomainModel\BookRepository;
use MyCompany\Book\DomainModel\BookEntity;

class FakeBookRepository implements BookRepository
{
    public function save(BookEntity $bookEntity)
    {
        return null;
    }

    public function delete(BookEntity $bookEntity)
    {
        return null;
    }

    public function getById(string $id)
    {
        return new BookEntity();
    }

    public function getAll(int $limit = null, int $offset = null)
    {
        return [new BookEntity()];
    }
}
