<?php

namespace App\Repository;

use App\Entity\Technos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Technos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Technos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Technos[]    findAll()
 * @method Technos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechnosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Technos::class);
    }

    // /**
    //  * @return Technos[] Returns an array of Technos objects
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
    public function findOneBySomeField($value): ?Technos
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
