<?php declare(strict_types=1);

namespace Publishing\Tests\Unit\Article;

use PHPUnit\Framework\TestCase;
use Publishing\Cms\Application\Model\Article\Article;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Publishing\Cms\Application\Model\Article\Article
 */
class ArticleTest extends TestCase
{
    public function testName()
    {
        $foo = 'foo';
        self::assertEquals('foo', $foo);
    }

    public function testPostNewArticleHasDefaultValues(): void
    {
        $id = Uuid::uuid4();
        $article = Article::post($id, 'a title');

        self::assertEquals($id, $article->getArticleId());
        self::assertEquals('a title', $article->getTitle());
        self::assertNull($article->getContent());
        self::assertNull($article->getPublicationStart());
        self::assertNull($article->getPublicationEnd());
    }

    public function testPostAsDraftHasDefaultTitle(): void
    {
        $id = Uuid::uuid4();
        $article = Article::postAsDraft($id);

        self::assertEquals($id, $article->getArticleId());
        self::assertEquals('Draft', $article->getTitle());
    }
}
