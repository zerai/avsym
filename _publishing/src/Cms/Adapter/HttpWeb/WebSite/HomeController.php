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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this-> render('@web-site/home.html.twig',[]);
    }

    #[Route('/info', name: 'sys_php_info')]
    public function info(): Response
    {
        echo phpinfo();

        return $this->render('phpinfo.html.twig',[
        ]);
    }
}
