<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Repository\EtablisementRepository;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    #[IsGranted('ROLE_USER')]
    public function index(PrestationRepository $prestationRepository, EtablisementRepository $etablisementRepository) : Response
    {
        $user = $this->getUser();
        $prestations = $prestationRepository->findAll();
        $countprestation = count($prestations);
        $etablissement = $etablisementRepository->findAll();
        $countetablissement = count($etablissement);
        return $this->render('home/index.html.twig', [
            'user' => $user,
            'countprestation' => $countprestation,
            'countetablissement' => $countetablissement
        ]);
    }
}
