<?php

namespace Dbt\Resolver\Common;

interface Resolver
{
    /**
     * @param string $key
     * @param mixed ...$args
     */
    public function resolve (string $key, ...$args): object;
}
