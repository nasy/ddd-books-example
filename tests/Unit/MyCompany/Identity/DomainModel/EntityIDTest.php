<?php

namespace tests\Unit\MyCompany\Identity\DomainModel;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Identity\Infrastructure\UUID;

class EntityIDTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $id = new UUID();
        $this->assertSame(UUID::class, get_class($id));
    }

    public function testCreate()
    {
        $id = UUID::create();
        // Id
        $this->assertNotEmpty($id->id());
        $this->assertInternalType('string', $id->id());
        $this->assertStringMatchesFormat('%x-%x-4%x-%x-%x', $id->id());
    }
}
