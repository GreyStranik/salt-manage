<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\CpuModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CpuModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CpuModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CpuModel[]    findAll()
 * @method CpuModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpuModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CpuModel::class);
    }

    public function cpu_static(){
        $str = "SELECT cpu_model.name cpu_model, count(1) as cn
                FROM helpers.cpu_model
                left join minion ON minion.cpu_model_id=cpu_model.id
                group by cpu_model.name";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('cpu_model', 'name');
        $rsm->addScalarResult('cn','value');

        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();

        return $data;

    }

    // /**
    //  * @return CpuModel[] Returns an array of CpuModel objects
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
    public function findOneBySomeField($value): ?CpuModel
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
