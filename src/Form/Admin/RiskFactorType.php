<?php

namespace App\Form\Admin;

use App\Entity\Polimorphism;
use App\Entity\RiskFactor;
use App\Repository\PolimorphismRepository;
use App\Repository\RiskFactorTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RiskFactorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'scores', IntegerType::class,
                [
                    'attr' => ['min' => '0']
                ]
            )
            ->add(
                'enabled', CheckboxType::class, [
                'required' => false,
            ]
            )
            ->add(
                'polimorphism', EntityType::class, [
                    'class' => Polimorphism::class,
                    'choice_label' => 'name',
                    'query_builder' => function (PolimorphismRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->where('p.enabled = true');
                    },
                ]
            )
            ->add(
                'riskFactorType', EntityType::class, [
                    'class' => \App\Entity\RiskFactorType::class,
                    'choice_label' => 'name',
                    'query_builder' => function (RiskFactorTypeRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->where('p.enabled = true');
                    },
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => RiskFactor::class,
            ]
        );
    }
}
