<?php

namespace App\Form\Admin;

use App\Entity\PreventionWay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreventionWayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'minTotalPoints', IntegerType::class,
                [
                    'attr' => ['min' => '0']
                ]
            )
            ->add(
                'enabled', CheckboxType::class, [
                'required' => false,
            ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => PreventionWay::class,
            ]
        );
    }
}
