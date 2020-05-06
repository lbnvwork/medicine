<?php

namespace App\Repository;

use App\Entity\PatientTestingResult;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientTestingResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientTestingResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientTestingResult[]    findAll()
 * @method PatientTestingResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientTestingResultRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientTestingResult::class);
    }

    // /**
    //  * @return PatientTestingResult[] Returns an array of PatientTestingResult objects
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
    public function findOneBySomeField($value): ?PatientTestingResult
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
