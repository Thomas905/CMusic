<?php

namespace App\Controller;

use App\Entity\Etablisement;
use App\Form\EtablisementType;
use App\Repository\EtablisementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etablissement")
 * @IsGranted("ROLE_USER")
 */
class EtablissementController extends AbstractController
{
    /**
     * @Route("/", name="etablissement_index", methods={"GET"})
     */
    public function index(EtablisementRepository $etablisementRepository): Response
    {
        return $this->render('etablissement/index.html.twig', [
            'etablisements' => $etablisementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etablissement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etablisement = new Etablisement();
        $form = $this->createForm(EtablisementType::class, $etablisement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etablisement);
            $entityManager->flush();

            return $this->redirectToRoute('etablisement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etablissement/new.html.twig', [
            'etablissement' => $etablisement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="etablissement_show", methods={"GET"})
     */
    public function show(Etablisement $etablisement): Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablisement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etablissement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Etablisement $etablisement, EntityManagerInterface $entityManager): Response
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

    /**
     * @Route("/{id}", name="etablissement_delete", methods={"POST"})
     */
    public function delete(Request $request, Etablisement $etablisement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablisement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etablisement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
