<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Soft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soft|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soft|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soft[]    findAll()
 * @method Soft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soft::class);
    }

    public function soft_static(){
        $str = "with installed as ( SELECT 
          count(1) OVER (PARTITION BY soft_id) cn,
           soft_id
            FROM public.installed_software
        )
        select distinct soft.id, soft.name, installed.cn from helpers.soft
        left join installed on installed.soft_id=soft.id
        where cn is not null
            order by soft.name";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult("id","id");
        $rsm->addScalarResult("name","name");
        $rsm->addScalarResult("cn", "count");

        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();

        return $data;
    }

    public function simple_find(string $search){
        $str = "select id, name from helpers.soft
                where upper(name) like :name
                order by name
                limit 5";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id','id');
        $rsm->addScalarResult('name','value');
        $data = $this->getEntityManager()->createNativeQuery($str,$rsm)
            ->setParameter("name",mb_strtoupper("%$search%"))->getArrayResult();
        return $data;
    }

    // /**
    //  * @return Soft[] Returns an array of Soft objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soft
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
