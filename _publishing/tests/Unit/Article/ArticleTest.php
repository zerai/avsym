<?php

namespace Publishing\Tests\Unit\Article;

use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testName()
    {
        $foo = 'foo';
        self::assertEquals('foo', $foo);
    }
}