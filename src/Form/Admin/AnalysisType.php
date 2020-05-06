<?php

namespace App\Form\Admin;

use App\Entity\Analysis;
use App\Entity\AnalysisGroup;
use App\Repository\AnalysisGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Форма анализа
 * Class AnalysisType
 *
 * @package App\Form\Admin
 */
class AnalysisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add(
                'enabled', CheckboxType::class, [
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
            'data_class' => Analysis::class,
        ]);
    }
}
