<?php

namespace App\Form\Admin;

use App\Entity\AnalysisGroup;
use App\Entity\Diagnosis;
use App\Entity\Patient;
use App\Entity\PatientTesting;
use App\Repository\AnalysisGroupRepository;
use App\Repository\PatientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class PatientTestingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'analysisDate',
                DateType::class,
                ['widget' => 'single_text']
            )
            ->add(
                'gestationalMinAge', IntegerType::class,
                [
                    'attr' => ['min' => '1']
                ]
            )
            ->add(
                'gestationalMaxAge', IntegerType::class,
                [
                    'attr' => ['min' => '1']
                ]
            )
            ->add(
                'processed', CheckboxType::class, [
                    'required' => false,
                ]
            )
            ->add(
                'analysisGroup', EntityType::class, [
                    'class' => AnalysisGroup::class,
                    'choice_label' => 'name',
                    'query_builder' => function (AnalysisGroupRepository $er) {
                        return $er->createQueryBuilder('d')
                            ->where('d.enabled = true');
                    },
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientTesting::class,
        ]);
    }
}
