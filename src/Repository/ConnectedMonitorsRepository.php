<?php

namespace App\Repository;

use App\Entity\ConnectedMonitors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectedMonitors|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectedMonitors|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectedMonitors[]    findAll()
 * @method ConnectedMonitors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectedMonitorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectedMonitors::class);
    }

    /**
     * @param $minion
     * @return ConnectedMonitors[]
     */
    public function findActual($minion){
        return $this->createQueryBuilder('m')
            ->andWhere('m.connected = :connected')
            ->andWhere('m.minion = :minion')
            ->setParameter('connected',true)
            ->setParameter('minion',$minion)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return ConnectedMonitors[] Returns an array of ConnectedMonitors objects
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
    public function findOneBySomeField($value): ?ConnectedMonitors
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
