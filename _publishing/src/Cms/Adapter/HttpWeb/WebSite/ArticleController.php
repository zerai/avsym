<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\WebSite;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\Application\Model\Article\Article;
use Publishing\Cms\Application\Viewcase\PublishedArticles\FindAllPublishedArticles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article_index')]
    public function index(Request $request, QueryBus $queryBus): Response
    {
        $articles = $queryBus->send(new FindAllPublishedArticles());

        $pager = new Pagerfanta(
            new ArrayAdapter($articles)
        );

        $pager->setMaxPerPage(2);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@web-site/article/index.html.twig', [
            'pager' => $pager,
        ]);
    }

    #[Route('/article/{id}/show', name: 'app_article_show')]
    public function show(Request $request, CommandBus $commandBus, DocumentStore $documentStore): Response
    {
        $articleId = $request->get('id');

        $article = $documentStore->getDocument(Article::class, $articleId);

        return $this->render('@web-site/article/show.html.twig', [
            'article' => $article,
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }
}
