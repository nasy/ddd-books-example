<?php

namespace MyCompany\Invoice\Application;

use MyCompany\Book\Application\CreateLineItemRequest;
use MyCompany\Invoice\DomainModel\InvoiceEntity;
use MyCompany\Invoice\DomainModel\InvoiceRepository;

class CreateLineItemAction
{
    /** @var InvoiceRepository */
    private $invoiceRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @param CreateLineItemRequest $createLineItemRequest
     * @return InvoiceEntity
     */
    public function run(CreateLineItemRequest $createLineItemRequest)
    {
        $invoice = $this->invoiceRepository->getById($createLineItemRequest->id());
        $invoice->addLineItem('Test', 10);

        /**
         * Case 1
         *
         * $lineItem = new InvoiceLineItemEntity();
         * $lineItem->invoice_id = $invoice->id;
         * $lineItem->title = 'Test';
         * $lineItem->total = 10;
         * $this->invoiceRepository->save($lineItem);
         *
         * What happened here? Potential problems?
         */

        $this->invoiceRepository->save($invoice);

        return $invoice;
    }
}
