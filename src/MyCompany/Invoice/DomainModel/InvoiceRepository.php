<?php

namespace MyCompany\Invoice\DomainModel;

interface InvoiceRepository
{
    /**
     * @param InvoiceEntity $invoice
     * @return InvoiceEntity
     */
    public function save(InvoiceEntity $invoice);

    /**
     * @param string $id
     * @return InvoiceEntity
     */
    public function getById(string $id) : InvoiceEntity;

}