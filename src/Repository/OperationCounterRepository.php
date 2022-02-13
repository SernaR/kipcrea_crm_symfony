<?php

namespace App\Repository;

use App\Entity\OperationCounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationCounter[]    findAll()
 * @method OperationCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationCounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationCounter::class);
    }

    // /**
    //  * @return OperationCounter[] Returns an array of OperationCounter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationCounter
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
