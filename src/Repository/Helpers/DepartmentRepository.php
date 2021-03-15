<?php

namespace App\Repository\Helpers;

use App\Entity\Helpers\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Department::class);
    }

    public function departments_static(){
        $str = "SELECT department.name department, count(1) cn
                FROM helpers.department
                left join minion on minion.department_id = department.id
                group by department.name
                order by count(1) desc";
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('department', 'name');
        $rsm->addScalarResult('cn','value');

        $data_tmp = $this->getEntityManager()->createNativeQuery($str,$rsm)->getResult();

        $data = array_splice($data_tmp,0,5);
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

    public function findAllOrdered(){
        return $this->createQueryBuilder('d')
                     ->orderBy('d.name',"ASC")
                     ->getQuery()->getResult();
    }

    // /**
    //  * @return Department[] Returns an array of Department objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Department
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
