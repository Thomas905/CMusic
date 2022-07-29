<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablisementType;
use App\Form\SearchEtablissementType;
use App\Repository\EtablisementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/etablissement')]
#[IsGranted('ROLE_USER')]
class EtablissementController extends AbstractController
{
    #[Route(path: '/', name: 'etablissement_index')]
    public function index(Request $request, EtablisementRepository $etablisementRepository) : Response
    {
        $form = $this->createForm(SearchEtablissementType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $etablisement = $etablisementRepository->findLikeName($search);
        } else {
            $etablisement = $etablisementRepository->findAll();
        }
        return $this->render('etablissement/index.html.twig', [
            'etablisements' => $etablisement,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/new', name: 'etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $etablisement = new Etablissement();
        $form = $this->createForm(EtablisementType::class, $etablisement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etablisement);
            $entityManager->flush();

            return $this->redirect('/etablissement/' . $etablisement->getId());
        }
        return $this->renderForm('etablissement/new.html.twig', [
            'etablissement' => $etablisement,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'etablissement_show', methods: ['GET'])]
    public function show(Etablissement $etablisement) : Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablisement,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablisement, EntityManagerInterface $entityManager) : Response
    {
        $form = $this->createForm(EtablisementType::class, $etablisement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('etablissement_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('etablissement/edit.html.twig', [
            'etablissement' => $etablisement,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablisement, EntityManagerInterface $entityManager) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablisement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etablisement);
            $entityManager->flush();
        }
        return $this->redirectToRoute('etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
