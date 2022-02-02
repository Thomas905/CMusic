<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'user' => $user,
        ]);
    }
}
