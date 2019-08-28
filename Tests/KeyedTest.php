<?php

namespace Dbt\Resolver\Tests;

use Dbt\Resolver\Common\ClassDoesNotExist;
use Dbt\Resolver\Common\KeyDoesNotExist;
use Dbt\Resolver\Keyed;
use Dbt\Resolver\Tests\Fixtures\StringClass;

class KeyedTest extends UnitTestCase
{
    /** @test */
    public function resolving ()
    {
        $class = StringClass::class;
        $key = self::rs(8);
        $arg = self::rs(16);
        $resolver = Keyed::of([$key => $class]);

        $gotten = $resolver->get($key);

        $this->assertSame($class, $gotten);

        $resolved = $resolver->resolve($key, $arg);

        $this->assertInstanceOf($class, $resolved);
        $this->assertSame($arg, $resolved->string());
    }

    /** @test */
    public function failing_with_bad_fqcn ()
    {
        $this->expectException(ClassDoesNotExist::class);

        Keyed::of([self::rs(8) => 'this-class-does-not-exist']);
    }

    /** @test */
    public function failing_to_resolve ()
    {
        $this->expectException(KeyDoesNotExist::class);

        $resolver = Keyed::of([]);

        $resolver->resolve('this-key-does-not-exist');
    }
}
