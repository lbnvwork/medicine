<?php

namespace App\Form\Admin;

use App\Entity\Region;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('region_number')
            ->add(
                'enabled', CheckboxType::class, [
                    'required' => false,
                ]
            )
            ->add(
                'country', EntityType::class, [
                    'class' => Country::class,
                    'choice_label' => 'name',
                    'query_builder' => function (CountryRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->where('c.enabled = true');
                    },
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Region::class,
            ]
        );
    }
}
