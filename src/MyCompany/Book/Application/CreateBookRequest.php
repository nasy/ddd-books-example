<?php

namespace MyCompany\Book\Application;

use MyCompany\Identity\DomainModel\EntityID;

class CreateBookRequest
{
    /** @var EntityID */
    private $id;
    /** @var string */
    private $title;

    public function __construct(
        EntityID $id,
        string $title = null,
        string $author = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * @return EntityID
     */
    public function id() : EntityID
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
