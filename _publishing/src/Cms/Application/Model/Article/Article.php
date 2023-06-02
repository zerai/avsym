<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\Article;

use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\WithAggregateEvents;
use Ramsey\Uuid\UuidInterface;

#[Aggregate]
class Article
{
    use WithAggregateEvents;

    #[AggregateIdentifier]
    private UuidInterface $articleId;

    private string $title;

    private ?string $content = null;

    private ?\DateTimeImmutable $publicationStart = null;

    private ?\DateTimeImmutable $publicationEnd = null;

    public static function post(UuidInterface $articleId, string $title): self
    {
        $article = new self();
        $article->articleId = $articleId;
        $article->title = $title;

        //$article->recordThat(new SessionWasStarted($article->sessionId));

        return $article;
    }

    public static function postAsDraft(UuidInterface $articleId): self
    {
        $article = new self();
        $article->articleId = $articleId;
        $article->title = 'Draft';

        //$article->recordThat(new SessionWasStarted($article->sessionId));

        return $article;
    }

    public function getArticleId(): UuidInterface
    {
        return $this->articleId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getPublicationStart(): ?\DateTimeImmutable
    {
        return $this->publicationStart;
    }

    public function getPublicationEnd(): ?\DateTimeImmutable
    {
        return $this->publicationEnd;
    }
}
