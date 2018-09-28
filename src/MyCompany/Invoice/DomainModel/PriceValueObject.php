<?php

namespace MyCompany\Book\DomainModel;

class PriceValueObject
{
    private $value;
    private $currency;

    public function __construct(
        float $value,
        string $currency
    ){
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

}