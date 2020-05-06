<?php

namespace App\Form\Admin;

use App\Entity\Region;
use App\Entity\District;
use App\Repository\RegionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DistrictType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'region', EntityType::class, [
                    'class' => Region::class,
                    'choice_label' => 'name',
                    'query_builder' => function (RegionRepository $er) {
                        return $er->createQueryBuilder('r')
                            ->where('r.enabled = true');
                    },
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
                'data_class' => District::class,
            ]
        );
    }
}
