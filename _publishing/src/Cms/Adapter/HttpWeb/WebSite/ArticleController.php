<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\WebSite;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\Application\Model\Article\Article;
use Publishing\Cms\Application\Model\Article\PostNewArticle\PostNewArticle;
use Publishing\Cms\Application\Viewcase\PublishedArticles\FindAllPublishedArticles;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/new', name: 'app_article')]
    public function new(CommandBus $commandBus): Response
    {
        $command = new PostNewArticle();
        $command->articleId = Uuid::uuid4();
        $commandBus->send($command);

        return $this->render('base.html.twig', [
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }

    #[Route('/article', name: 'app_article_list')]
    public function list(Request $request, QueryBus $queryBus): Response
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
