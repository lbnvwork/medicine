<?php

namespace App\Repository;

use App\Entity\PatientTesting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientTesting|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientTesting|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientTesting[]    findAll()
 * @method PatientTesting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientTestingRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientTesting::class);
    }

    // /**
    //  * @return PatientTesting[] Returns an array of PatientTesting objects
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
    public function findOneBySomeField($value): ?PatientTesting
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
