<?php

namespace Dbt\Resolver\Common;

interface Dictionary
{
    public function has (string $key): bool;

    /**
     * @return mixed
     */
    public function get (string $key);
}
