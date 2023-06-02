<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\Article\PostNewArticle;

use Ramsey\Uuid\UuidInterface;

class PostNewArticle
{
    public function __construct(
        public UuidInterface $articleId,
        public string $title
    ) {
    }
}
