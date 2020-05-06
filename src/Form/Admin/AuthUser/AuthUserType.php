<?php

namespace App\Form\Admin\AuthUser;

use App\Entity\AuthUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, ['label' => 'Имя'])
            ->add('lastName', null, ['label' => 'Фамилия'])
            ->add('patronymicName')
            ->add(
                'phone',
                TelType::class,
                [
                    'label' => 'Телефон',
                    'attr' => ['pattern' => '\d{10}'],
                    'help' => 'Введите телефон 10 цифр',
                ]
            )
            ->add(
                'email',
                EmailType::class
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'attr' => ['pattern' => '\S{6,}'],
                    'help' => 'Введите пароль не менее 8 знаков, включая английские символы, спецсимволы и цифры',
                    'always_empty' => false,
                    'required' => false,
                    'trim' => true
                ]
            )
            ->add('description')
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
                'data_class' => AuthUser::class,
            ]
        );
    }
}
