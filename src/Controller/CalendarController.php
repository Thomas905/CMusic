<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\PrestationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/calendar', name: 'calendar_')]
#[IsGranted('ROLE_USER')]
class CalendarController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function calendar(PrestationRepository $prestationRepository): Response
    {
        $prestations = $prestationRepository->findAll();
        $array = [];
        foreach($prestations as $key) {
            $array[] = [
                'id' => $key->getId(),
                'title' => $key->getEtablissement()->getName() . '-' . $key->getEtablissement()->getCity(),
                'etablissement_name' => $key->getEtablissement()->getName(),
                'start' => $key->getStartTime()->format('Y-m-d H:i:s'),
                'end' => $key->getEndTime()->format('Y-m-d H:i:s'),
                'color' => $key->getColor(),
            ];
        }

        $data = json_encode($array);

        return $this->render('calendar/index.html.twig', [
            'data' => $data,
        ]);
    }
}
