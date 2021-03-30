<?php

namespace App\Repository\Equipment;

use App\Entity\Equipment\Printer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Printer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Printer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Printer[]    findAll()
 * @method Printer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrinterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Printer::class);
    }

    public function printer_list(){
        $str = "SELECT printer.id, printer.serial, printer_model.name, minion.id minion_id, minion.node_name,
                vendor.name as vendor_name
                    FROM equipment.printer
                    left join equipment.printer_model ON printer_model.id = printer.model_id
                    left join helpers.vendor ON vendor.id = printer_model.vendor_id
                    left join connected_printers on connected_printers.printer_id = printer.id
                    left join minion ON minion.id = connected_printers.minion_id
                    where connected_printers.connected";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult("id","id");
        $rsm->addScalarResult("serial","serial");
        $rsm->addScalarResult("name","name");
        $rsm->addScalarResult("minion_id","minion_id");
        $rsm->addScalarResult("node_name","node_name");
        $rsm->addScalarResult("vendor_name","vendor_name");

        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();
        return $data;
    }
    // /**
    //  * @return Printer[] Returns an array of Printer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Printer
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
