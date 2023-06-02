<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\WebAdmin;

use Ecotone\Messaging\Store\Document\DocumentStore;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use JobPosting\Application\Model\JobPost\JobPost;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Publishing\Cms\Adapter\HttpWeb\WebAdmin\Form\ArticleType;
use Publishing\Cms\Adapter\HttpWeb\WebAdmin\Form\Dto\ArticleDto;
use Publishing\Cms\Application\Model\Article\Article;
use Publishing\Cms\Application\Model\Article\PostNewArticle\PostNewArticle;
use Publishing\Cms\Application\Viewcase\PublishedArticles\FindAllPublishedArticles;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminArticleController extends AbstractController
{
    #[Route('/article/new', name: 'web_admin_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommandBus $commandBus): Response
    {
        $articleFormModel = new ArticleDto();
        $form = $this->createForm(ArticleType::class, $articleFormModel, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ArticleDto $formData */
            $formData = $form->getData();

            $command = new PostNewArticle(Uuid::uuid4(), $formData->title);

            //            $jobPost = new JobPost(Uuid::uuid4(), $formData->title);
            //            $jobPost->setDescription($formData->description);
            //
            //            if (null !== $formData->publicationStart) {
            //                $jobPost->setPublicationStart($formData->publicationStart);
            //            }
            //
            //            if (null !== $formData->publicationEnd) {
            //                $jobPost->setPublicationEnd($formData->publicationEnd);
            //            }

            $commandBus->send($command);

            $this->addFlash('success', 'Nuova articolo creato');

            return $this->redirectToRoute('web_admin_article_index');
        }
        return $this->renderForm('@web-admin/article/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/article', name: 'web_admin_article_index')]
    public function index(Request $request, QueryBus $queryBus): Response
    {
        $articles = $queryBus->send(new FindAllPublishedArticles());

        $pager = new Pagerfanta(
            new ArrayAdapter($articles)
        );

        $pager->setMaxPerPage(2);
        $pager->setCurrentPage((int) $request->query->get('page', '1'));

        return $this->render('@web-admin/article/index.html.twig', [
            'pager' => $pager,
        ]);
    }

    #[Route('/article/{id}/show', name: 'web_admin_article_show')]
    public function show(Request $request, CommandBus $commandBus, DocumentStore $documentStore): Response
    {
        $articleId = $request->get('id');

        $article = $documentStore->getDocument(Article::class, $articleId);

        return $this->render('@web-admin/article/show.html.twig', [
            'article' => $article,
            'message' => 'Welcome to MedicalMundi!',
        ]);
    }

    /**
     * @Route("admin/article/delete/{id}", name="web_admin_article_delete")
     */
    public function delete(Request $request, DocumentStore $documentStore): Response
    {
        //        $jobPost = $this->jobPostRepository->findOneBy([
        //            'id' => $request->get('id'),
        //        ]);
        //
        //        $this->jobPostRepository->remove($jobPost, true);

        $documentStore->deleteDocument(Article::class, (string) $request->get('id'));

        $this->addFlash('success', 'Articolo eliminata');

        return $this->redirectToRoute('web_admin_article_index');
    }
}
