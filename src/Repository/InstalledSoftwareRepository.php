<?php

namespace App\Repository;

use App\Entity\InstalledSoftware;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InstalledSoftware|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstalledSoftware|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstalledSoftware[]    findAll()
 * @method InstalledSoftware[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstalledSoftwareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstalledSoftware::class);
    }

    // /**
    //  * @return InstalledSoftware[] Returns an array of InstalledSoftware objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InstalledSoftware
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
