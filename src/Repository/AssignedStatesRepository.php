<?php

namespace App\Repository;

use App\Entity\AssignedStates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssignedStates|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssignedStates|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssignedStates[]    findAll()
 * @method AssignedStates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignedStatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssignedStates::class);
    }

    // /**
    //  * @return AssignedStates[] Returns an array of AssignedStates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssignedStates
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
