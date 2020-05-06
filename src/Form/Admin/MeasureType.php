<?php

namespace App\Form\Admin;

use App\Entity\Measure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MeasureType
 * Форма единицы измерения
 *
 * @package App\Form\Admin
 */
class MeasureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameRu')
            ->add('nameEn')
            ->add('title')
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
                'data_class' => Measure::class,
            ]
        );
    }
}
