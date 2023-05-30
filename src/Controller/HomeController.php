<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome!',
            //'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/info', name: 'app_info')]
    public function info(): Response
    {
        echo phpinfo();

        return $this->render('phpinfo.html.twig',[

        ]);
    }

}
