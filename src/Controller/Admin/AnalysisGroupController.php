<?php

namespace App\Controller\Admin;

use App\Entity\AnalysisGroup;
use App\Form\Admin\AnalysisGroupType;
use App\Repository\AnalysisGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры сущности "Группа анализов"
 * @Route("/admin/analysis_group")
 * @IsGranted("ROLE_ADMIN")
 */
class AnalysisGroupController extends AbstractController
{
    //путь к twig шаблонам
    private const TEMPLATE_PATH = 'admin/analysis_group/';

    /**
     * @Route("/", name="analysis_group_index", methods={"GET"})
     */
    public function index(AnalysisGroupRepository $analysisGroupRepository): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'index.html.twig', [
                'analysis_groups' => $analysisGroupRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="analysis_group_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $analysisGroup = new AnalysisGroup();
        $form = $this->createForm(AnalysisGroupType::class, $analysisGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($analysisGroup);
            $entityManager->flush();

            return $this->redirectToRoute('analysis_group_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'new.html.twig', [
                'analysis_group' => $analysisGroup,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH
            ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_group_show", methods={"GET"})
     */
    public function show(AnalysisGroup $analysisGroup): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'show.html.twig', [
                'analysis_group' => $analysisGroup,
                'template_path' => self::TEMPLATE_PATH
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="analysis_group_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnalysisGroup $analysisGroup): Response
    {
        $form = $this->createForm(AnalysisGroupType::class, $analysisGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_group_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'edit.html.twig', [
                'analysis_group' => $analysisGroup,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH
            ]
        );
    }

    /**
     * @Route("/{id}", name="analysis_group_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AnalysisGroup $analysisGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analysisGroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($analysisGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('analysis_group_index');
    }
}
