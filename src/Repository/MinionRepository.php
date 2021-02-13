<?php

namespace App\Repository;

use App\Entity\Minion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Minion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minion[]    findAll()
 * @method Minion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minion::class);
    }

    function count_info(){
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('count','count');
        $count = $this->getEntityManager()
            ->createNativeQuery("SELECT count(1) count FROM public.minion ",$rsm)
            ->getSingleResult();

        $count_today = $this->getEntityManager()
            ->createNativeQuery("SELECT count(1) count
                        FROM public.minion
                        where date_trunc('day',updated_at)=CURRENT_DATE",$rsm)
            ->getSingleResult();

        $count_low_month = $this->getEntityManager()
            ->createNativeQuery("SELECT count(1) count
                        FROM public.minion
                        where date_trunc('day',updated_at)<CURRENT_DATE-'1 month'::interval",$rsm)
            ->getSingleResult();
//
        return [
            'count_all' => $count['count'],
            'count_today' => $count_today['count'],
            'count_low_month' => $count_low_month['count']
        ];
    }

    // /**
    //  * @return Minion[] Returns an array of Minion objects
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
    public function findOneBySomeField($value): ?Minion
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
