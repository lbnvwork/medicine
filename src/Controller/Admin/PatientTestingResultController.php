<?php

namespace App\Controller\Admin;

use App\Entity\PatientTesting;
use App\Entity\PatientTestingResult;
use App\Form\PatientTestingResultType;
use App\Repository\PatientTestingResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class PatientTestingResultController
 * Контроллеры результатов анализа
 *
 * @Route("/admin/patient/testing_result")
 * @IsGranted("ROLE_ADMIN")
 *
 * @package App\Controller\Admin
 */
class PatientTestingResultController extends AbstractController
{
    /**
     * @Route("/", name="patient_testing_result_index", methods={"GET"})
     */
    public function index(PatientTestingResultRepository $patientTestingResultRepository): Response
    {
        return $this->render('patient_testing_result/index.html.twig', [
            'patient_testing_results' => $patientTestingResultRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="patient_testing_result_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patientTestingResult = new PatientTestingResult();
        $form = $this->createForm(PatientTestingResultType::class, $patientTestingResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var PatientTesting $patientTesting */
            $patientTesting = $entityManager->getRepository(PatientTesting::class)->find($request->query->get('id'));
            $patientTestingResult->setPatientTesting($patientTesting);
            $entityManager->persist($patientTestingResult);
            $entityManager->flush();

            return $this->redirectToRoute('patient_testing_result_index');
        }

        return $this->render('patient_testing_result/new.html.twig', [
            'patient_testing_result' => $patientTestingResult,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_testing_result_show", methods={"GET"})
     */
    public function show(PatientTestingResult $patientTestingResult): Response
    {
        return $this->render('patient_testing_result/show.html.twig', [
            'patient_testing_result' => $patientTestingResult,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="patient_testing_result_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PatientTestingResult $patientTestingResult): Response
    {
        $form = $this->createForm(PatientTestingResultType::class, $patientTestingResult);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_testing_result_index');
        }

        return $this->render('patient_testing_result/edit.html.twig', [
            'patient_testing_result' => $patientTestingResult,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_testing_result_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PatientTestingResult $patientTestingResult): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patientTestingResult->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patientTestingResult);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_testing_result_index');
    }
}
