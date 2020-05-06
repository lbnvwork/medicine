<?php

namespace App\Controller\Admin;

use App\Entity\Diagnosis;
use App\Form\Admin\DiagnosisType;
use App\Repository\DiagnosisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("admin/diagnosis")
 * @IsGranted("ROLE_ADMIN")
 */
class DiagnosisController extends AbstractController
{
    /**
     * @Route("/", name="diagnosis_index", methods={"GET"})
     */
    public function index(DiagnosisRepository $diagnosisRepository): Response
    {
        return $this->render(
            'admin/diagnosis/index.html.twig', [
                'diagnoses' => $diagnosisRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="diagnosis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $diagnosi = new Diagnosis();
        $form = $this->createForm(DiagnosisType::class, $diagnosi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($diagnosi);
            $entityManager->flush();

            return $this->redirectToRoute('diagnosis_index');
        }

        return $this->render(
            'admin/diagnosis/new.html.twig', [
                'diagnosi' => $diagnosi,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/find_diagnosis_ajax", name="find_diagnosis_ajax", methods={"GET"})
     * @return false|string
     */
    public function findDiagnosisAjax(Request $request)
    {
        $string = $request->query->get('q');
        $entityManager = $this->getDoctrine()->getManager();
        $diagnoses = $entityManager->getRepository(Diagnosis::class)->findDiagnoses($string);
        $resultArray = [];
        /** @var Diagnosis $diagnosis */
        foreach ($diagnoses as $diagnosis) {
            $resultArray[] = [
                'id' => $diagnosis->getId(),
                'text' => $diagnosis->getName()
            ];
        }
        return new Response(
            json_encode(
                $resultArray
            )
        );
    }

    /**
     * @Route("/{id}", name="diagnosis_show", methods={"GET"})
     */
    public function show(Diagnosis $diagnosis): Response
    {
        return $this->render(
            'admin/diagnosis/show.html.twig', [
                'diagnosis' => $diagnosis,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="diagnosis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Diagnosis $diagnosis): Response
    {
        $form = $this->createForm(DiagnosisType::class, $diagnosis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diagnosis_index');
        }

        return $this->render(
            'admin/diagnosis/edit.html.twig', [
                'diagnosi' => $diagnosis,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="diagnosis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Diagnosis $diagnosis): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diagnosis->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($diagnosis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('diagnosis_index');
    }
}
