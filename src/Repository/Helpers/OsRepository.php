<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Os;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Os|null find($id, $lockMode = null, $lockVersion = null)
 * @method Os|null findOneBy(array $criteria, array $orderBy = null)
 * @method Os[]    findAll()
 * @method Os[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Os::class);
    }

    public function os_static(){
        $str = "SELECT os.name os_name, count(1) cn
                    FROM helpers.os
                    left join minion on minion.os_id = os.id
                    group by os.name
                    order by count(1) desc";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('os_name', 'name');
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
    //  * @return Os[] Returns an array of Os objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Os
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
