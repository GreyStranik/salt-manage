<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Manufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Manufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manufacturer[]    findAll()
 * @method Manufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    public function manufacturer_static(){
        $str = "SELECT manufacturer.name as manufacturer_name, count(1) cn
                    FROM helpers.manufacturer
                left join minion on minion.manufacturer_id=manufacturer.id
                group by manufacturer.name
                order by count(1)";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('manufacturer_name', 'name');
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
    //  * @return Manufacturer[] Returns an array of Manufacturer objects
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
    public function findOneBySomeField($value): ?Manufacturer
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
