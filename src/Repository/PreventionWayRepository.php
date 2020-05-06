<?php

namespace App\Repository;

use App\Entity\PreventionWay;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreventionWay|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreventionWay|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreventionWay[]    findAll()
 * @method PreventionWay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreventionWayRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreventionWay::class);
    }

    // /**
    //  * @return PreventionWay[] Returns an array of PreventionWay objects
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
    public function findOneBySomeField($value): ?PreventionWay
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
