<?php

namespace MyCompany\Identity\DomainModel;

abstract class EntityID
{
    /** @var string */
    private $id;

    abstract public static function createFromID(string $id) : EntityID;

    abstract public static function create() : EntityID;

    /**
     * @return string
     */
    public function id() : string
    {
        return $this->id;
    }
}