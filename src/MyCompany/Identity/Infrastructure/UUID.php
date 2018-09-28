<?php

namespace MyCompany\Identity\Infrastructure;

use MyCompany\Identity\DomainModel\InvalidIDException;
use MyCompany\Identity\DomainModel\EntityID;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UUID extends EntityID
{
    /** @var string */
    private $id;

    public static function createFromID(string $id) : EntityID
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidIDException('Invalid UUID');
        }
        $self = new self();
        $self->id = $id;
        return $self;
    }

    public static function create() : EntityID
    {
        $self = new self();
        $self->id = RamseyUuid::uuid4()->toString();
        return $self;
    }

    /**
     * @return string
     */
    public function id() : string
    {
        return $this->id;
    }
}