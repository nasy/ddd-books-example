<?php

namespace AppBundle\Response;

use MyCompany\Invoice\DomainModel\InvoiceEntity;

class InvoiceResponse
{
    /** @var InvoiceEntity */
    private $invoice;

    public function __construct(InvoiceEntity $invoice)
    {
        $this->invoice = $invoice;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->invoice->id(),
            'title' => $this->invoice->title(),
        ];
    }
}
