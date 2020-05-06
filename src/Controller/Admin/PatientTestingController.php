<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use App\Entity\PatientTesting;
use App\Form\Admin\PatientTestingType;
use App\Repository\PatientTestingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class PatientTestingController
 * Контроллеры проведения анализов пациента
 *
 * @Route("/admin/patient_testing")
 * @IsGranted("ROLE_ADMIN")
 *
 * @package App\Controller\Admin
 */
class PatientTestingController extends AbstractController
{
    //путь к twig шаблонам
    private const TEMPLATE_PATH = 'admin/patient_testing/';

    /**
     * @Route("/", name="patient_testing_index", methods={"GET"})
     */
    public function index(PatientTestingRepository $patientTestingRepository): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'index.html.twig', [
                'patient_testings' => $patientTestingRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="patient_testing_new", methods={"GET","POST"})
     * @param Request $request
     * @param Patient $patient
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $patientTesting = new PatientTesting();
        $form = $this->createForm(PatientTestingType::class, $patientTesting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Patient $patient */
            $patient = $entityManager->getRepository(Patient::class)->find($request->query->get('id'));
            $patientTesting->setPatient($patient);
            $entityManager->persist($patientTesting);
            $entityManager->flush();

            return $this->redirectToRoute('patient_testing_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'new.html.twig', [
                'patient_testing' => $patientTesting,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="patient_testing_show", methods={"GET"})
     */
    public function show(PatientTesting $patientTesting): Response
    {
        return $this->render(
            self::TEMPLATE_PATH.'show.html.twig', [
                'patient_testing' => $patientTesting,
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="patient_testing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PatientTesting $patientTesting): Response
    {
        $form = $this->createForm(PatientTestingType::class, $patientTesting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_testing_index');
        }

        return $this->render(
            self::TEMPLATE_PATH.'edit.html.twig', [
                'patient_testing' => $patientTesting,
                'form' => $form->createView(),
                'template_path' => self::TEMPLATE_PATH,
            ]
        );
    }

    /**
     * @Route("/{id}", name="patient_testing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PatientTesting $patientTesting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patientTesting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patientTesting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_testing_index');
    }
}
