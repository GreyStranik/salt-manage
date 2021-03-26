<?php

namespace App\Repository\Equipment;

use App\Entity\Equipment\MonitorModels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MonitorModels|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonitorModels|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonitorModels[]    findAll()
 * @method MonitorModels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonitorModelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonitorModels::class);
    }

    // /**
    //  * @return MonitorModels[] Returns an array of MonitorModels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MonitorModels
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
