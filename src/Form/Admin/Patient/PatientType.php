<?php

namespace App\Form\Admin\Patient;

use App\Entity\City;
use App\Entity\Diagnosis;
use App\Entity\Hospital;
use App\Entity\Patient;
use App\Entity\District;
use App\Entity\Polimorphism;
use App\Entity\RiskFactor;
use App\Repository\CityRepository;
use App\Repository\DistrictRepository;
use App\Repository\HospitalRepository;
use App\Repository\PolimorphismRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class PatientType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'dateBirth',
                DateType::class,
                ['widget' => 'single_text']
            )
            ->add(
                'snils',
                TextType::class,
                [
                    'attr' =>
                        ['pattern' => '^\d{3}-\d{3}-\d{3}-\d{2}$'],
                    'help' => '888-888-888-88',
                ]

            )
            ->add('insuranceNumber')
            ->add('dateStartOfTreatment')
            ->add('address')
            ->add('smsInforming')
            ->add('emailInforming')
            ->add('importantComment')
            ->add('concomitantDisease')
            ->add('passport')
            ->add(
                'city',
                EntityType::class,
                [
                    'class' => City::class,
                    'choice_label' => 'name',
                    'query_builder' => function (CityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->where('c.enabled = true');
                    },
                ]
            )
            ->add(
                'district', EntityType::class, [
                    'class' => District::class,
                    'choice_label' => 'name',
                    'query_builder' => function (DistrictRepository $er) {
                        return $er->createQueryBuilder('d')
                            ->where('d.enabled = true');
                    },
                ]
            )
            ->add(
                'hospital', EntityType::class, [
                    'class' => Hospital::class,
                    'choice_label' => 'name',
                    'query_builder' => function (HospitalRepository $er) {
                        return $er->createQueryBuilder('h')
                            ->where('h.enabled = true');
                    },
                ]
            )
            ->add(
                'polimorphism', EntityType::class, [
                    'class' => Polimorphism::class,
                    'choice_label' => 'name',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function (PolimorphismRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->where('p.enabled = true');
                    },
                ]
            )
            ->add(
                'diagnosis', Select2EntityType::class, [
                    'multiple' => true,
                    'remote_route' => 'find_diagnosis_ajax',
                    'class' => Diagnosis::class,
                    'primary_key' => 'id',
                    'text_property' => 'name',
                    'minimum_input_length' => 3,
                    'page_limit' => 1,
                    'allow_clear' => true,
                    'delay' => 250,
                    'language' => 'ru',
                    'placeholder' => 'Выберите диагноз',
                ]
            )
            ->add(
                'riskFactor', EntityType::class, [
                    'label' => ' ',
                    'class' => RiskFactor::class,
                    'attr' => ['style' => 'display:none'],
                    'choice_label' => 'name',
                    'expanded' => true,
                    'multiple' => true,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Patient::class,
            ]
        );
    }
}
