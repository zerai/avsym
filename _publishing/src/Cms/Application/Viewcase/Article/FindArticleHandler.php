<?php

namespace Publishing\Cms\Application\Viewcase\Article;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\Attribute\QueryHandler;
use Publishing\Cms\Application\Model\Article\Article;

class FindArticleHandler
{
    private const DOCUMENT_COLLECTION = Article::class;

    private DocumentStore $documentStore;

    public function __construct(DocumentStore $documentStore)
    {
        $this->documentStore = $documentStore;
    }

    #[QueryHandler]
    public function findArticleById(FindArticle $query): Article
    {
        return $this->documentStore->getDocument(self::DOCUMENT_COLLECTION, $query->articleId);
    }
}