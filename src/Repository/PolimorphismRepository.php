<?php

namespace App\Repository;

use App\Entity\Polimorphism;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Polimorphism|null find($id, $lockMode = null, $lockVersion = null)
 * @method Polimorphism|null findOneBy(array $criteria, array $orderBy = null)
 * @method Polimorphism[]    findAll()
 * @method Polimorphism[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PolimorphismRepository extends AppRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Polimorphism::class);
    }

    // /**
    //  * @return Polimorphism[] Returns an array of Polimorphism objects
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
    public function findOneBySomeField($value): ?Polimorphism
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
