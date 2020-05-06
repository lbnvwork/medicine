<?php

namespace App\Repository;

use App\Entity\AnalysisRate;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnalysisRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnalysisRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnalysisRate[]    findAll()
 * @method AnalysisRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnalysisRateRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnalysisRate::class);
    }

    // /**
    //  * @return AnalysisRate[] Returns an array of AnalysisRate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnalysisRate
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
