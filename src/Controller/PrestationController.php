<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sasedev\MpdfBundle\Factory\MpdfFactory;

#[Route(path: '/prestation')]
class PrestationController extends AbstractController
{
    #[Route(path: '/', name: 'prestation_index', methods: ['GET'])]
    public function index(PrestationRepository $prestationRepository) : Response
    {
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
        ]);
    }

    #[Route(path: '/{id}/generate/invoice', name: 'prestation_pdf_invoice', methods: ['GET'])]
    public function show(Prestation $prestation, MpdfFactory $MpdfFactory) : Response
    {
        $user = $this->getUser();
        $mPdf = $MpdfFactory->createMpdfObject([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P'
        ]);
        $mPdf->SetHTMLHeader($this->renderView('pdf/invoice.html.twig', [
            'prestation' => $prestation,
            'user' => $user
        ]));
        return $MpdfFactory->createDownloadResponse($mPdf, "file.pdf");
    }

    #[Route(path: '/new', name: 'prestation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirect('/etablissement/' . $prestation->getEtablissement()->getId());
        }
        return $this->renderForm('prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'prestation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prestation $prestation, EntityManagerInterface $entityManager) : Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirect('/etablissement/' . $prestation->getEtablissement()->getId());
        }
        return $this->renderForm('prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'prestation_delete', methods: ['POST'])]
    public function delete(Request $request, Prestation $prestation, EntityManagerInterface $entityManager) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($prestation);
            $entityManager->flush();
        }
        return $this->redirectToRoute('prestation_index', [], Response::HTTP_SEE_OTHER);
    }
}
