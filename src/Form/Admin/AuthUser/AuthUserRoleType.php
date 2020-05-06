<?php


namespace App\Form\Admin\AuthUser;


use App\Entity\AuthUser;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthUserRoleType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = $this->entityManager->getRepository(Role::class)->findBy(['enabled' => true]);
        $rolesArray = [];
        /** @var Role $role */
        foreach ($roles as $role) {
            $rolesArray[$role->getName()] = $role->getTechName();
        }
        $builder
            ->add(
                'roles', ChoiceType::class, [
                    'choices' => $rolesArray
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