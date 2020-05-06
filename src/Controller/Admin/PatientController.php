<?php

namespace App\Controller\Admin;

use App\Entity\AuthUser;
use App\Entity\Patient;
use App\Form\Admin\Patient\PatientRiskFactorType;
use App\Form\Admin\AuthUser\AuthUserType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/patient")
 * @IsGranted("ROLE_ADMIN")
 */
class PatientController extends AbstractController
{
    private const PATIENT_ROLE = 'ROLE_PATIENT';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render(
            'admin/patient/index.html.twig', [
                'patients' => $patientRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patient = new Patient();
        $user = new AuthUser();
        $patient->setAuthUser($user);
        $form = $this->createFormBuilder()
            ->add('authUser', AuthUserType::class)
            ->add('patient', \App\Form\Admin\Patient\PatientType::class)
            ->getForm();
        $this->setRiskFactors($request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var AuthUser $authUser */
            $authUser = $data['authUser'];
            /** @var Patient $patient */
            $patient = $data['patient'];
            $authUser->setRoles(self::PATIENT_ROLE);
            // See https://symfony.com/doc/current/security.html#c-encoding-passwords
            $encodedPassword = $this->passwordEncoder->encodePassword($authUser, $authUser->getPassword());
            $authUser->setPassword($encodedPassword);
            $em = $this->getDoctrine()->getManager();
            $em->persist($authUser);
            $em->flush();
            $patient->setAuthUser($authUser);
            $em->persist($data['patient']);
            $em->flush();
            $this->addFlash('success', 'post.created_successfully');

            return $this->redirectToRoute('patient_index');
        }

        return $this->render(
            'admin/patient/new.html.twig', [
                'patient' => $patient,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient): Response
    {
        $authUser = $patient->getAuthUser();
        return $this->render(
            'admin/patient/show.html.twig', [
                'patient' => $patient,
                'auth_user' => $authUser
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient): Response
    {
        $totalScores = $this->getDoctrine()->getManager()->getRepository(Patient::class)->getPreventionWay($patient);
        $authUser = $patient->getAuthUser();
        $form = $this->createFormBuilder()
            ->setData(
                [
                    'authUser' => $authUser,
                    'patient' => $patient
                ]
            )
            ->add('authUser', AuthUserType::class)
            ->add('patient', \App\Form\Admin\Patient\PatientType::class)
            ->add('riskFactor', PatientRiskFactorType::class)
            ->getForm();
        $checkedRiskFactors = $patient->getRiskFactor();
        $oldPassword = $authUser->getPassword();
        $this->setRiskFactors($request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $authUser->getPassword();
            $authUser->setPassword($oldPassword);
            if ($newPassword) {
                // See https://symfony.com/doc/current/security.html#c-encoding-passwords
                $encodedPassword = $this->passwordEncoder->encodePassword($authUser, $newPassword);
                if ($encodedPassword !== $oldPassword) {
                    $authUser->setPassword($encodedPassword);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_index');
        }

        //begin устанавливаю флажок checked в группах факторов риска в форме
        /** @var FormView $formView */
        $formView = $form->createView();
        foreach ($checkedRiskFactors as $factor) {
            /**
             * @var string $key
             * @var FormView $value
             */
            foreach ($formView->offsetGet('riskFactor')->children as $key => $value) {
                if (strpos($key, PatientRiskFactorType::RISK_FACTOR_GROUP_TITLE) !== false) {
                    foreach ($value->children as $riskFactorFormViewKey => $riskFactorFormViewValue) {
                        if ($factor->getId() == $riskFactorFormViewKey) {
                            $riskFactorFormViewValue->vars['checked'] = true;
                        }
                    }
                }
            }
        }
        //end устанавливаю флажок checked в группах факторов риска в форме

        return $this->render(
            'admin/patient/edit.html.twig', [
                'patient' => $patient,
                'form' => $formView,
            ]
        );
    }

    /**
     * @Route("/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_index');
    }

    /**
     * Устанавливает факторы риска из групп факторов риска в request
     *
     * @param Request $request
     */
    private function setRiskFactors(Request $request): void
    {
        $form = $request->request->get('form');
        $formPatientData = $request->request->get('form')['riskFactor'];
        $riskFactorArr = [];
        $i = 1;
        while (isset($formPatientData[PatientRiskFactorType::RISK_FACTOR_GROUP_TITLE.$i])) {
            $riskFactor = $formPatientData[PatientRiskFactorType::RISK_FACTOR_GROUP_TITLE.$i];
            $riskFactorArr = array_merge($riskFactorArr, $riskFactor);
            $i++;
        }
        $form['patient']['riskFactor'] = $riskFactorArr;
        $request->request->set('form', $form);
    }
}
