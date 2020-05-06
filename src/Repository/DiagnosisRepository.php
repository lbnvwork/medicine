<?php

namespace App\Repository;

use App\Entity\Diagnosis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Diagnosis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diagnosis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diagnosis[]    findAll()
 * @method Diagnosis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiagnosisRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diagnosis::class);
    }

    /**
     * Ищет диагнозы по части строки в полях код и имя диагноза
     *
     * @param string $value
     *
     * @return Diagnosis[] Returns an array of Diagnosis objects
     */
    public function findDiagnoses(string $value): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('LOWER(d.name) LIKE LOWER(:valName)')
            ->orWhere('LOWER(d.code) LIKE LOWER(:valCode)')
            ->setParameter('valName', '%'.$value.'%')
            ->setParameter('valCode', $value.'%')
            ->orderBy('d.name', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Diagnosis[] Returns an array of Diagnosis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diagnosis
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
