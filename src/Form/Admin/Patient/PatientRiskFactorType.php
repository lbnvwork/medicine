<?php


namespace App\Form\Admin\Patient;


use App\Entity\Patient;
use App\Entity\RiskFactor;
use App\Repository\RiskFactorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class PatientRiskFactorType extends AbstractType
{
    public const RISK_FACTOR_GROUP_TITLE = 'riskFactorGroup';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $riskFactorTypes = $this->entityManager->getRepository(\App\Entity\RiskFactorType::class)->findBy(['enabled' => true]);
        /** @var \App\Entity\RiskFactorType $factorType */
        foreach ($riskFactorTypes as $factorType) {
            $builder->add(
                'riskFactorGroup'.$factorType->getId(), EntityType::class, [
                    'mapped' => false,
                    'label' => $factorType->getName(),
                    'class' => RiskFactor::class,
                    'choice_label' => 'name',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function (RiskFactorRepository $er) use ($factorType) {
                        return $er->createQueryBuilder('p')
                            ->where('p.enabled = true')
                            ->andWhere('p.riskFactorType = '.$factorType->getId());
                    },
                ]
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Patient::class,
            ]
        );
    }
}