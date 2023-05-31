<?php

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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

}



