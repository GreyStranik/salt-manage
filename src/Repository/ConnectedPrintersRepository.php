<?php

namespace App\Repository;

use App\Entity\ConnectedPrinters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectedPrinters|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectedPrinters|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectedPrinters[]    findAll()
 * @method ConnectedPrinters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectedPrintersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectedPrinters::class);
    }

    // /**
    //  * @return ConnectedPrinters[] Returns an array of ConnectedPrinters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConnectedPrinters
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
