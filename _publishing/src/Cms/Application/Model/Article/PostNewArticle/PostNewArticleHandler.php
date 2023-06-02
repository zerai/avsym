<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\Article\PostNewArticle;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\Attribute\CommandHandler;
use Publishing\Cms\Application\Model\Article\Article;

class PostNewArticleHandler
{
    #[CommandHandler]
    public function postNew(PostNewArticle $command, DocumentStore $documentStore): Article
    {
        $article = Article::post($command->articleId, $command->title);

        $documentStore->addDocument(Article::class, (string) $article->getArticleId(), $article);

        return $article;
    }
}
