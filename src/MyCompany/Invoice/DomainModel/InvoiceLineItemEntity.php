<?php

namespace MyCompany\Invoice\DomainModel;

use MyCompany\Identity\DomainModel\EntityID;

class InvoiceLineItemEntity
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $price;
    /** @var \DateTime */
    private $createdAt;

    public static function create(
        EntityID $id,
        string $title,
        string $price
    ) {
        $self = new self();
        $self->id = $id->id();
        $self->title = $title;
        $self->price = $price;
        $self->createdAt = new \Datetime("now");
        return $self;
    }

    /**
     * @return string
     */
    public function id() : string
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function price() : float
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function createdAt() : \DateTime
    {
        return $this->createdAt;
    }
}