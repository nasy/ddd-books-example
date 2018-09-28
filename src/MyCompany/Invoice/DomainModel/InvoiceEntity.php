<?php

namespace MyCompany\Invoice\DomainModel;

use MyCompany\Identity\DomainModel\EntityID;
use MyCompany\Identity\Infrastructure\UUID;

class InvoiceEntity
{
    /** @var string */
    private $id;
    /** @var float */
    private $total;
    /** @var \DateTime */
    private $createdAt;

    /** @var array */
    private $lineItems;

    public static function create(
        EntityID $id,
        float $total
    ) {
        $self = new self();
        $self->id = $id->id();
        $self->total = $total;
        $self->createdAt = new \Datetime("now");
        $self->lineItems = [];
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
    public function total() : float
    {
        return $this->total;
    }

    /**
     * @return \DateTime
     */
    public function createdAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $title
     * @param float $total
     */
    public function addLineItem(string $title, float $total)
    {
        $this->lineItems[] = InvoiceLineItemEntity::create(
            UUID::create(),
            $title,
            $total
        );
        $this->calculateTotal();
    }

    public function calculateTotal() {

        $total = 0;
        /** @var InvoiceLineItemEntity $lineItem */
        foreach ($this->lineItems as $lineItem) {
            $total = $total + $lineItem->price();
        }
        $this->total = $total;
    }
}