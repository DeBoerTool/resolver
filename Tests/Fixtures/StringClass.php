<?php

namespace Dbt\Resolver\Tests\Fixtures;

class StringClass
{
    /** @var string */
    private $string;

    public function __construct (string $string)
    {
        $this->string = $string;
    }

    public function string (): string
    {
        return $this->string;
    }
}
