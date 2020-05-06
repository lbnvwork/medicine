<?php

namespace App\Form;

use App\Entity\PatientTestingResult;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientTestingResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('result')
            ->add('enabled')
            ->add('patientTesting')
            ->add('analysisRate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientTestingResult::class,
        ]);
    }
}
