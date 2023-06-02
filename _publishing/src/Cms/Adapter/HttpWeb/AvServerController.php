<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvServerController extends AbstractController
{
    #[Route('/fe', name: 'app_avserver_fe')]
    public function index(): Response
    {
        $content = '';

        if (\function_exists('proc_open')) {
            $content .= "proc_open() functions are available.<br />\n";
        } else {
            $content .= "proc_open() functions are not available.<br />\n";
        }
        return new Response($content);
    }
}
