<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\OsFullName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OsFullName|null find($id, $lockMode = null, $lockVersion = null)
 * @method OsFullName|null findOneBy(array $criteria, array $orderBy = null)
 * @method OsFullName[]    findAll()
 * @method OsFullName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsFullNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OsFullName::class);
    }

    // /**
    //  * @return OsFullName[] Returns an array of OsFullName objects
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
    public function findOneBySomeField($value): ?OsFullName
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
