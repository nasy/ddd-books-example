<?php

namespace MyCompany\Book\DomainModel;

interface BookRepository
{
    /**
     * @param BookEntity $bookEntity
     * @return BookEntity
     */
    public function save(BookEntity $bookEntity);

    /**
     * @param BookEntity $bookEntity
     * @return void
     */
    public function delete(BookEntity $bookEntity);

    /**
     * @param string $id
     * @return BookEntity
     */
    public function getById(string $id) : BookEntity;

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAll(int $limit = 25, int $offset = 0);
}