<?php

namespace App\Controller\Admin;

use App\Entity\RiskFactor;
use App\Form\Admin\RiskFactorType;
use App\Repository\RiskFactorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры для сущности "Фактор риска"
 * @Route("/admin/risk_factor")
 * @IsGranted("ROLE_ADMIN")
 */
class RiskFactorController extends AbstractController
{
    /**
     * @Route("/", name="risk_factor_index", methods={"GET"})
     */
    public function index(RiskFactorRepository $riskFactorRepository): Response
    {
        return $this->render(
            'admin/risk_factor/index.html.twig', [
                'risk_factors' => $riskFactorRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="risk_factor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $riskFactor = new RiskFactor();
        $form = $this->createForm(RiskFactorType::class, $riskFactor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($riskFactor);
            $entityManager->flush();

            return $this->redirectToRoute('risk_factor_index');
        }

        return $this->render(
            'admin/risk_factor/new.html.twig', [
                'risk_factor' => $riskFactor,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="risk_factor_show", methods={"GET"})
     */
    public function show(RiskFactor $riskFactor): Response
    {
        return $this->render(
            'admin/risk_factor/show.html.twig', [
                'risk_factor' => $riskFactor,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="risk_factor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RiskFactor $riskFactor): Response
    {
        $form = $this->createForm(RiskFactorType::class, $riskFactor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('risk_factor_index');
        }

        return $this->render(
            'admin/risk_factor/edit.html.twig', [
                'risk_factor' => $riskFactor,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="risk_factor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RiskFactor $riskFactor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$riskFactor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($riskFactor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('risk_factor_index');
    }
}
