<?php

namespace Publishing\Cms\Application\Viewcase\PublishedArticles;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\Attribute\QueryHandler;
use Publishing\Cms\Application\Model\Article\Article;

class FindAllPublishedArticlesHandler
{
    private const DOCUMENT_COLLECTION = Article::class;

    private DocumentStore $documentStore;

    public function __construct(DocumentStore $documentStore)
    {
        $this->documentStore = $documentStore;
    }

    #[QueryHandler]
    public function findAllPublishedArticles(FindAllPublishedArticles $query): array
    {
        return $this->documentStore->getAllDocuments(self::DOCUMENT_COLLECTION);
    }
}