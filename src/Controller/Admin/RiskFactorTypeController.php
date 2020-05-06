<?php

namespace App\Controller\Admin;

use App\Entity\RiskFactorType;
use App\Form\Admin\RiskFactorTypeType;
use App\Repository\RiskFactorTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры для сущности "Тип (группа) фактора риска"
 * @Route("/admin/risk_factor_type")
 * @IsGranted("ROLE_ADMIN")
 */
class RiskFactorTypeController extends AbstractController
{
    /**
     * @Route("/", name="risk_factor_type_index", methods={"GET"})
     */
    public function index(RiskFactorTypeRepository $riskFactorTypeRepository): Response
    {
        return $this->render(
            'admin/risk_factor_type/index.html.twig', [
                'risk_factor_types' => $riskFactorTypeRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="risk_factor_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $riskFactorType = new RiskFactorType();
        $form = $this->createForm(RiskFactorTypeType::class, $riskFactorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($riskFactorType);
            $entityManager->flush();

            return $this->redirectToRoute('risk_factor_type_index');
        }

        return $this->render(
            'admin/risk_factor_type/new.html.twig', [
                'risk_factor_type' => $riskFactorType,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="risk_factor_type_show", methods={"GET"})
     */
    public function show(RiskFactorType $riskFactorType): Response
    {
        return $this->render(
            'admin/risk_factor_type/show.html.twig', [
                'risk_factor_type' => $riskFactorType,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="risk_factor_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RiskFactorType $riskFactorType): Response
    {
        $form = $this->createForm(RiskFactorTypeType::class, $riskFactorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('risk_factor_type_index');
        }

        return $this->render(
            'admin/risk_factor_type/edit.html.twig', [
                'risk_factor_type' => $riskFactorType,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="risk_factor_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RiskFactorType $riskFactorType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$riskFactorType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($riskFactorType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('risk_factor_type_index');
    }
}
