<?php

namespace App\Controller\Admin;

use App\Entity\Hospital;
use App\Form\Admin\HospitalType;
use App\Repository\HospitalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/hospital")
 * @IsGranted("ROLE_ADMIN")
 */
class HospitalController extends AbstractController
{
    /**
     * @Route("/", name="hospital_index", methods={"GET"})
     */
    public function index(HospitalRepository $hospitalRepository): Response
    {
        return $this->render(
            'admin/hospital/index.html.twig', [
            'hospitals' => $hospitalRepository->findAll(),
        ]
        );
    }

    /**
     * @Route("/new", name="hospital_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hospital = new Hospital();
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hospital);
            $entityManager->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render(
            'admin/hospital/new.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
        ]
        );
    }

    /**
     * @Route("/{id}", name="hospital_show", methods={"GET"})
     */
    public function show(Hospital $hospital): Response
    {
        return $this->render(
            'admin/hospital/show.html.twig', [
            'hospital' => $hospital,
        ]
        );
    }

    /**
     * @Route("/{id}/edit", name="hospital_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hospital $hospital): Response
    {
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render(
            'admin/hospital/edit.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
        ]
        );
    }

    /**
     * @Route("/{id}", name="hospital_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hospital $hospital): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hospital->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hospital);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hospital_index');
    }
}
