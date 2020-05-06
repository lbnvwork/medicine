<?php

namespace App\Controller\Admin;

use App\Entity\AnalysisRate;
use App\Form\Admin\AnalysisRateType;
use App\Repository\AnalysisRateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры предельных нормальных значений
 * @Route("/admin/analysis_rate")
 * @IsGranted("ROLE_ADMIN")
 */
class AnalysisRateController extends AbstractController
{
    //путь к twig шаблонам
    private const TEMPLATE_PATH = 'admin/analysis_rate/';

    /**
     * @Route("/", name="analysis_rate_index", methods={"GET"})
     */
    public function index(AnalysisRateRepository $analysisRateRepository): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'index.html.twig', [
                'analysis_rates' => $analysisRateRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="analysis_rate_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $analysisRate = new AnalysisRate();
        $form = $this->createForm(AnalysisRateType::class, $analysisRate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($analysisRate);
            $entityManager->flush();

            return $this->redirectToRoute('analysis_rate_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'new.html.twig', [
                'analysis_rate' => $analysisRate,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_rate_show", methods={"GET"})
     */
    public function show(AnalysisRate $analysisRate): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'show.html.twig', [
                'analysis_rate' => $analysisRate,
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="analysis_rate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnalysisRate $analysisRate): Response
    {
        $form = $this->createForm(AnalysisRateType::class, $analysisRate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_rate_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'edit.html.twig', [
                'analysis_rate' => $analysisRate,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_rate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AnalysisRate $analysisRate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analysisRate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($analysisRate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('analysis_rate_index');
    }
}
