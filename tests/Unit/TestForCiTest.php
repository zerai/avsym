<?php declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

class TestForCiTest extends TestCase
{
    public function testName()
    {
        $foo = 'foo';
        self::assertEquals('foo', $foo);
    }
}
