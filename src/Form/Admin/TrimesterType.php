<?php

namespace App\Form\Admin;

use App\Entity\Trimester;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Форма триместра
 * Class TrimesterType
 *
 * @package App\Form\Admin
 */
class TrimesterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('title')
            ->add(
                'number', IntegerType::class,
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
                'data_class' => Trimester::class,
            ]
        );
    }
}
