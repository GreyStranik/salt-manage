<?php

namespace App\Repository\Equipment;

use App\Entity\Equipment\Monitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Monitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monitor[]    findAll()
 * @method Monitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monitor::class);
    }

    public function monitor_list(){
        $str="SELECT connected_monitors.id, monitor.id monitor_id, monitor.serial, monitor_models.name, minion.id minion_id, minion.node_name,
                vendor.name as vendor_name, monitor.year, monitor.week
                    FROM equipment.monitor
                    left join equipment.monitor_models ON monitor_models.id = monitor.model_id
                    left join helpers.vendor ON vendor.id = monitor_models.vendor_id
                    left join connected_monitors on connected_monitors.monitor_id = monitor.id
                    left join minion ON minion.id = connected_monitors.minion_id
                    where connected_monitors.connected";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult("id","id");
        $rsm->addScalarResult("serial","serial");
        $rsm->addScalarResult("name","name");
        $rsm->addScalarResult("minion_id","minion_id");
        $rsm->addScalarResult("node_name","node_name");
        $rsm->addScalarResult("vendor_name","vendor_name");
        $rsm->addScalarResult("year","year");
        $rsm->addScalarResult("week","week");

        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();
        return $data;
    }
    // /**
    //  * @return Monitor[] Returns an array of Monitor objects
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
    public function findOneBySomeField($value): ?Monitor
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
