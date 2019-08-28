<?php

namespace Dbt\Resolver;

use Dbt\Resolver\Common\ClassDoesNotExist;
use Dbt\Resolver\Common\Dictionary;
use Dbt\Resolver\Common\KeyDoesNotExist;
use Dbt\Resolver\Common\Resolver;

final class Keyed implements Resolver, Dictionary
{
    /** @var array */
    protected $mappings;

    public function __construct (array $mappings)
    {
        $this->mappings = [];

        $this->pushMany($mappings);
    }

    public static function of (array $mappings): self
    {
        return new self($mappings);
    }

    public function pushMany (array $mappings)
    {
        foreach ($mappings as $key => $class) {
            $this->push($key, $class);
        }
    }

    public function push (string $key, string $fqcn)
    {
        if (!class_exists($fqcn)) {
            throw ClassDoesNotExist::of($fqcn);
        }

        $this->mappings[$key] = $fqcn;
    }

    public function has (string $key): bool
    {
        return array_key_exists($key, $this->mappings);
    }

    public function get (string $key)
    {
        return $this->mappings[$key];
    }

    public function resolve (string $key, ...$args): object
    {
        if ($this->has($key)) {
            $fqcn = $this->get($key);

            return new $fqcn(...$args);
        }

        throw KeyDoesNotExist::of($key);
    }
}
