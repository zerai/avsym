<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\WebSite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this-> render('@web-site/home.html.twig', []);
    }

    #[Route('/info', name: 'sys_php_info')]
    public function info(): Response
    {
        echo phpinfo();

        return $this->render('phpinfo.html.twig', [
        ]);
    }
}
