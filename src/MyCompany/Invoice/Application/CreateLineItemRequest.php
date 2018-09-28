<?php

namespace MyCompany\Book\Application;

use MyCompany\Identity\DomainModel\EntityID;

class CreateLineItemRequest
{
    /** @var EntityID */
    private $id;
    /** @var string */
    private $title;

    public function __construct(
        EntityID $id,
        string $title,
        double $price
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
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
     * @return double
     */
    public function price() : double
    {
        return $this->price;
    }
}
