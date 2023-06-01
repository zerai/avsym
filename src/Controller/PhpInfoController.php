<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PhpInfoController extends AbstractController
{
    #[Route('/info', name: 'sys_php_info')]
    public function info(): Response
    {
        echo phpinfo();

        return $this->render('phpinfo.html.twig',[
        ]);
    }
}
