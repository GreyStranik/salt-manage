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

    function new_minions(){
        $str = "SELECT id, node_name
                FROM public.minion
                where date_trunc('day',created_at)=CURRENT_DATE
                order by node_name";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult("id","id");
        $rsm->addScalarResult("node_name","node_name");
        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();
        return $data;
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

        $count_low_2week = $this->getEntityManager()
            ->createNativeQuery("SELECT count(1) count
                        FROM public.minion
                        where date_trunc('day',updated_at)<=CURRENT_DATE-'14 day'::interval",$rsm)
            ->getSingleResult();

        $count_low_month = $this->getEntityManager()
            ->createNativeQuery("SELECT count(1) count
                        FROM public.minion
                        where date_trunc('day',updated_at)<=CURRENT_DATE-'30 day'::interval",$rsm)
            ->getSingleResult();
//
        return [
            'count_all' => $count['count'],
            'count_today' => $count_today['count'],
            'count_low_2week' => $count_low_2week['count'],
            'count_low_month' => $count_low_month['count']
        ];
    }

    function simple_find(string $search){
        $str = "SELECT id, node_name
                FROM public.minion
                where upper(node_name) like :node_name
                order by node_name
                limit 5";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id','id');
        $rsm->addScalarResult('node_name','value');
        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->setParameter("node_name",mb_strtoupper("%$search%"))->getArrayResult();
        return $data;
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
