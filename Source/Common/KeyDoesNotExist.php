<?php

namespace Dbt\Resolver\Common;

use Exception;

class KeyDoesNotExist extends Exception
{
    public static $format = 'The given key "%s" does not exist.';

    public static function of (string $key): self
    {
        return new self(sprintf(self::$format, $key));
    }
}
