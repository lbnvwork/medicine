<?php

namespace App\Controller\DoctorOffice;

use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PatientsListController extends AbstractController
{
    /**
     * @Route("/doctor_office/patients", name="patients_list")
     * @IsGranted("ROLE_DOCTOR_HOSPITAL")
     */
    public function index(PatientRepository $patientRepository)
    {
        return $this->render(
            'doctorOffice/patients_list/index.html.twig', [
                'controller_name' => 'PatientsListController',
                'patients' => $patientRepository->findAll(),
            ]
        );
    }
}
