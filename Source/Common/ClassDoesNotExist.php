<?php

namespace Dbt\Resolver\Common;

use Exception;

class ClassDoesNotExist extends Exception
{
    public static $format = 'The given class "%s" does not exist.';

    public static function of (string $fqcn): self
    {
        return new self(sprintf(self::$format, $fqcn));
    }
}
