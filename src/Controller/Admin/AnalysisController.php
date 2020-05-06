<?php

namespace App\Controller\Admin;

use App\Entity\Analysis;
use App\Form\Admin\AnalysisType;
use App\Repository\AnalysisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры сущности "Анализ"
 * @Route("/admin/analysis")
 * @IsGranted("ROLE_ADMIN")
 */
class AnalysisController extends AbstractController
{
    //путь к twig шаблонам
    private const TEMPLATE_PATH = 'admin/analysis/';

    /**
     * @Route("/", name="analysis_index", methods={"GET"})
     */
    public function index(AnalysisRepository $analysisRepository): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'index.html.twig', [
            'analyses' => $analysisRepository->findAll(),
        ]
        );
    }

    /**
     * @Route("/new", name="analysis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $analysi = new Analysis();
        $form = $this->createForm(AnalysisType::class, $analysi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($analysi);
            $entityManager->flush();

            return $this->redirectToRoute('analysis_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'new.html.twig', [
            'analysi' => $analysi,
            'form' => $form->createView(),
            'template_path' => self::TEMPLATE_PATH,
        ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_show", methods={"GET"})
     */
    public function show(Analysis $analysi): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'show.html.twig', [
            'analysi' => $analysi,
            'template_path' => self::TEMPLATE_PATH,
        ]
        );
    }

    /**
     * @Route("/{id}/edit", name="analysis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Analysis $analysi): Response
    {
        $form = $this->createForm(AnalysisType::class, $analysi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'edit.html.twig', [
            'analysi' => $analysi,
            'form' => $form->createView(),
            'template_path' => self::TEMPLATE_PATH,
        ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Analysis $analysi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analysi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($analysi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('analysis_index');
    }
}
