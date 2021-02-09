<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Soft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soft|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soft|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soft[]    findAll()
 * @method Soft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soft::class);
    }

    // /**
    //  * @return Soft[] Returns an array of Soft objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soft
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
