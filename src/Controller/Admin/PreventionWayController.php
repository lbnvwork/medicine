<?php

namespace App\Controller\Admin;

use App\Entity\PreventionWay;
use App\Form\Admin\PreventionWayType;
use App\Repository\PreventionWayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Контроллеры для сущности "Способ профилактики ВТЭО"
 * @Route("/admin/prevention_way")
 * @IsGranted("ROLE_ADMIN")
 */
class PreventionWayController extends AbstractController
{
    /**
     * @Route("/", name="prevention_way_index", methods={"GET"})
     */
    public function index(PreventionWayRepository $preventionWayRepository): Response
    {
        return $this->render(
            'admin/prevention_way/index.html.twig', [
                'prevention_ways' => $preventionWayRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="prevention_way_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $preventionWay = new PreventionWay();
        $form = $this->createForm(PreventionWayType::class, $preventionWay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($preventionWay);
            $entityManager->flush();

            return $this->redirectToRoute('prevention_way_index');
        }

        return $this->render(
            'admin/prevention_way/new.html.twig', [
                'prevention_way' => $preventionWay,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="prevention_way_show", methods={"GET"})
     */
    public function show(PreventionWay $preventionWay): Response
    {
        return $this->render(
            'admin/prevention_way/show.html.twig', [
                'prevention_way' => $preventionWay,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="prevention_way_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PreventionWay $preventionWay): Response
    {
        $form = $this->createForm(PreventionWayType::class, $preventionWay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prevention_way_index');
        }

        return $this->render(
            'admin/prevention_way/edit.html.twig', [
                'prevention_way' => $preventionWay,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="prevention_way_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PreventionWay $preventionWay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preventionWay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($preventionWay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prevention_way_index');
    }
}
