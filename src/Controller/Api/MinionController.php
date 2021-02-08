<?php

namespace App\Controller\Api;

use App\Entity\Helpers\CpuModel;
use App\Entity\Helpers\Department;
use App\Entity\Helpers\Manufacturer;
use App\Entity\Helpers\ProductName;
use App\Entity\Helpers\Type;
use App\Entity\Helpers\TypeDep;
use App\Entity\Minion;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MinionController
 * @package App\Controller\Api
 * @Route("/api/minion")
 */
class MinionController extends AbstractController
{
    /**
     * @Route("/", name="api_get_all_minion", methods={"GET"})
     */
    public function index(): Response
    {
        $minions =$this->getDoctrine()->getRepository(Minion::class)->findAll();

        return $this->json($minions);
    }

    /**
     * @Route("/{uuid}", name="update_minion_data", methods={"POST"})
     * @return Response
     */
    public function update_minion_data($uuid, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $minion = $this->getDoctrine()->getRepository(Minion::class)->find($uuid);
        if (!$minion){
            $minion = new Minion(Uuid::fromString($uuid));
        }

        $minion->setNodeName($data['node_name']);
        $minion->setSelialnumber($data['serialnumber']);
        $minion->setBiosversion($data['biosversion']);
        $minion->setBiosreleasedate(new \DateTime($data['biosreleasedate']));
        $minion->setRoom($data['room']);

        $manufacturer = $this->getDoctrine()->getRepository(Manufacturer::class)->findOneBy(['name' => $data['manufacturer'] ]);
        if(!$manufacturer){
            $manufacturer = new Manufacturer();
            $manufacturer->setName($data['manufacturer']);
            $em->persist($manufacturer);
        }
        $minion->setManufacturer($manufacturer);


        $cpu_model = $this->getDoctrine()->getRepository(CpuModel::class)->findOneBy([
            'name' => $data['cpu_model']
        ]);
        if (!$cpu_model){
            $cpu_model = new CpuModel();
            $cpu_model->setName($data['cpu_model']);
            $em->persist($cpu_model);
        }
        $minion->setCpuModel($cpu_model);


        $product_name = $this->getDoctrine()->getRepository(ProductName::class)->findOneBy([
            'name' => $data['productname']
        ]);
        if(!$product_name){
            $product_name = new ProductName();
            $product_name->setName($data['productname']);
            $em->persist($product_name);
        }
        $minion->setProductName($product_name);

        $minion->setFioUser($data['fio_user']);
        $minion->setUserPhone($data['user_phone']);

        $type = $this->getDoctrine()->getRepository(Type::class)->findOneBy([
            'name' => $data['type']
        ]);
        if (!$type){
            $type = new Type();
            $type->setName($data['type']);
            $em->persist($type);
        }
        $minion->setType($type);

        $type_dep = $this->getDoctrine()->getRepository(TypeDep::class)->findOneBy([
            'name' => $data['type_dep']
        ]);
        if (!$type_dep){
            $type_dep = new TypeDep();
            $type_dep->setName($data['type_dep']);
            $em->persist($type_dep);
        }
        $minion->setTypeDep($type_dep);

        $department = $this->getDoctrine()->getRepository(Department::class)->findOneBy([
            'name' => $data['department']
        ]);
        if(!$department){
            $department = new Department();
            $department->setName($data['department']);
            $em->persist($department);
        }
        $minion->setDepartment($department);

        $minion->setSaltversion($data['saltversion']);

        $em->persist($minion);
        $em->flush();

        return $this->json(
            [
                'res' => $uuid,
                'data' => $data
            ]
        );
    }
}
