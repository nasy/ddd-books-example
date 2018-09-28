<?php

namespace MyCompany\Book\Application;

use MyCompany\Book\DomainModel\BookEntity;

class UpdateBookRequest
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $author;

    public function __construct(
        string $id,
        string $title = null,
        string $author = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function id() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title() : ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function author() : ?string
    {
        return $this->author;
    }
}
