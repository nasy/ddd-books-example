<?php

namespace tests\Unit\MyCompany\Identity\DomainModel;

use MyCompany\Identity\DomainModel\InvalidIDException;

class InvalidIDExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $exception = new InvalidIDException();
        $this->assertSame(InvalidIDException::class, get_class($exception));
    }
}