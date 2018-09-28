<?php

namespace MyCompany\Book\Infrastructure\Persistance\Fake;

use MyCompany\Book\DomainModel\InvoiceRepository;
use MyCompany\Book\DomainModel\BookEntity;

class FakeInvoiceRepository implements InvoiceRepository
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
