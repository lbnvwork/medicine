<?php

namespace App\Repository;

use App\Entity\Trimester;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trimester|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trimester|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trimester[]    findAll()
 * @method Trimester[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrimesterRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trimester::class);
    }

    // /**
    //  * @return Trimester[] Returns an array of Trimester objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trimester
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
