<?php

namespace App\Form\Admin;

use App\Entity\Analysis;
use App\Entity\AnalysisRate;
use App\Entity\Measure;
use App\Entity\Trimester;
use App\Repository\AnalysisRepository;
use App\Repository\MeasureRepository;
use App\Repository\TrimesterRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnalysisRateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rateMin')
            ->add('rateMax')
            ->add(
                'enabled', CheckboxType::class, [
                    'required' => false,
                ]
            )
            ->add(
                'analysis', EntityType::class, [
                    'class' => Analysis::class,
                    'choice_label' => 'name',
                    'query_builder' => function (AnalysisRepository $er) {
                        return $er->createQueryBuilder('d')
                            ->where('d.enabled = true');
                    },
                ]
            )
            ->add(
                'trimester', EntityType::class, [
                    'class' => Trimester::class,
                    'choice_label' => 'name',
                    'query_builder' => function (TrimesterRepository $er) {
                        return $er->createQueryBuilder('d')
                            ->where('d.enabled = true');
                    },
                ]
            )
            ->add(
                'measure', EntityType::class, [
                    'class' => Measure::class,
                    'choice_label' => 'name',
                    'query_builder' => function (MeasureRepository $er) {
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
            'data_class' => AnalysisRate::class,
        ]);
    }
}
