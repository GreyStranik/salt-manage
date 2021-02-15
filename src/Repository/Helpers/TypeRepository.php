<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function type_statistic(){
        $str = "SELECT type.name type_name, count(1) as cn
                FROM helpers.type
                left join minion on minion.type_id=type.id
                group by type.name
                order by count(1) desc";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('type_name', 'name');
        $rsm->addScalarResult('cn','value');

        $data_tmp = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();

        $data = array_splice($data_tmp,0,6);
        $val = 0;
        foreach ($data_tmp as $tmp){
            $val+=$tmp['value'];
        }
        if ($val>0){
            $data[] = [
                'name' => 'Прочие',
                'value' => $val
            ];
        }


        return $data;
    }

    // /**
    //  * @return Type[] Returns an array of Type objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Type
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
