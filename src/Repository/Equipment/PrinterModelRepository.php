<?php

namespace App\Repository\Equipment;

use App\Entity\Equipment\PrinterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrinterModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrinterModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrinterModel[]    findAll()
 * @method PrinterModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrinterModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrinterModel::class);
    }

    // /**
    //  * @return PrinterModel[] Returns an array of PrinterModel objects
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
    public function findOneBySomeField($value): ?PrinterModel
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
