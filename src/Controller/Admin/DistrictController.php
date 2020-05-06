<?php

namespace App\Controller\Admin;

use App\Entity\District;
use App\Form\Admin\DistrictType;
use App\Repository\DistrictRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/district")
 * @IsGranted("ROLE_ADMIN")
 */
class DistrictController extends AbstractController
{
    /**
     * @Route("/", name="district_index", methods={"GET"})
     */
    public function index(DistrictRepository $districtRepository): Response
    {
        return $this->render(
            'admin/district/index.html.twig', [
            'districts' => $districtRepository->findAll(),
        ]
        );
    }

    /**
     * @Route("/new", name="district_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $district = new District();
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($district);
            $entityManager->flush();

            return $this->redirectToRoute('district_index');
        }

        return $this->render(
            'admin/district/new.html.twig', [
            'district' => $district,
            'form' => $form->createView(),
        ]
        );
    }

    /**
     * @Route("/{id}", name="district_show", methods={"GET"})
     */
    public function show(District $district): Response
    {
        return $this->render(
            'admin/district/show.html.twig', [
            'district' => $district,
        ]
        );
    }

    /**
     * @Route("/{id}/edit", name="district_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, District $district): Response
    {
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('district_index');
        }

        return $this->render(
            'admin/district/edit.html.twig', [
            'district' => $district,
            'form' => $form->createView(),
        ]
        );
    }

    /**
     * @Route("/{id}", name="district_delete", methods={"DELETE"})
     */
    public function delete(Request $request, District $district): Response
    {
        if ($this->isCsrfTokenValid('delete'.$district->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($district);
            $entityManager->flush();
        }

        return $this->redirectToRoute('district_index');
    }
}
