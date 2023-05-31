<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\CommandBus;
use Publishing\Cms\Application\Model\Article\Article;
use Publishing\Cms\Application\Model\Article\PostNewArticle\PostNewArticle;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(CommandBus $commandBus): Response
    {
        $command = new PostNewArticle();
        $command->articleId = Uuid::uuid4();
        $commandBus->send($command);

        return $this->render('base.html.twig', [
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }

    #[Route('/article-list', name: 'app_article_list')]
    public function list(CommandBus $commandBus, DocumentStore $documentStore): Response
    {
        $articles = $documentStore->getAllDocuments(Article::class);

        dd($articles);

        return $this->render('base.html.twig', [
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }

}
