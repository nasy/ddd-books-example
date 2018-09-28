<?php

namespace MyCompany\Book\Infrastructure\Persistance\Doctrine;

use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\ORM\EntityManager;
use MyCompany\Invoice\DomainModel\InvoiceEntity;
use MyCompany\Invoice\DomainModel\InvoiceRepository;

class DoctrineInvoiceRepository implements InvoiceRepository
{
    /** @var EntityManager */
    private $em;
    /** @var RepositoryFactory */
    private $repository;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($entityClass);
    }

    public function save(InvoiceEntity $invoice)
    {
        $this->em->persist($invoice);
        $this->em->flush();
    }

    public function getById(string $id)
    {
        $bookEntity = $this->repository->find($id);
        if (!$bookEntity instanceof InvoiceEntity) {
            throw new InvoiceNotFoundException('Book Not Found');
        }
        return $bookEntity;
    }
}
