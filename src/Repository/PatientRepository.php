<?php

namespace App\Repository;

use App\Entity\Patient;
use App\Entity\PreventionWay;
use App\Entity\RiskFactor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\PersistentCollection;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function getTotalRiskFactorScores(Patient $patient)
    {
        $totalScores = 0;
        /** @var PersistentCollection $riskFactors */
        $riskFactors = $patient->getRiskFactor();
        /** @var RiskFactor $factor */
        foreach ($riskFactors as $factor) {
            $totalScores += $factor->getScores();
        }
        return $totalScores;
    }

    public function getPreventionWay(Patient $patient)
    {
        return $this->getEntityManager()->getRepository(PreventionWay::class)
            ->findOneBy(['minTotalPoints' => $this->getTotalRiskFactorScores($patient)], ['minTotalPoints' => 'DESC']);
    }
    // /**
    //  * @return Patient[] Returns an array of Patient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
