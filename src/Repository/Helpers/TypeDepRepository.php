<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\TypeDep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeDep|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDep|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDep[]    findAll()
 * @method TypeDep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDep::class);
    }

    // /**
    //  * @return TypeDep[] Returns an array of TypeDep objects
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
    public function findOneBySomeField($value): ?TypeDep
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
