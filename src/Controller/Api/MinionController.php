<?php

namespace App\Controller\Api;

use App\Entity\Disk;
use App\Entity\Helpers\CpuModel;
use App\Entity\Helpers\Department;
use App\Entity\Helpers\Manufacturer;
use App\Entity\Helpers\Os;
use App\Entity\Helpers\OsFullName;
use App\Entity\Helpers\ProductName;
use App\Entity\Helpers\Soft;
use App\Entity\Helpers\Type;
use App\Entity\Helpers\TypeDep;
use App\Entity\InstalledSoftware;
use App\Entity\IPs;
use App\Entity\Minion;
use App\Entity\Network;
use Psr\Log\LoggerInterface;
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
    public function update_minion_data($uuid, Request $request, LoggerInterface $logger): Response
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

        $minion->setOsrelease($data['osrelease']);

        $os = $this->getDoctrine()->getRepository(Os::class)->findOneBy([
            'name' => $data['os']
        ]);
        if (!$os){
            $os = new Os();
            $os->setName($data['os']);
            $em->persist($os);
        }
        $minion->setOs($os);

        $os_full_name = $this->getDoctrine()->getRepository(OsFullName::class)->findOneBy([
            'name' => $data['osfullname']
        ]);
        if (!$os_full_name){
            $os_full_name = new OsFullName();
            $os_full_name->setName($data['osfullname']);
            $em->persist($os_full_name);
        }
        $minion->setOsFullName($os_full_name);

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
        $minion->setMemTotal($data['mem_total']);


        $old_networks = $minion->getNetworks();
        foreach ($old_networks as $old_network){
            $intrfs = $old_network->getInterface();
            if (!array_key_exists($intrfs,$data['network'])){
                //$minion->removeNetwork($old_network)
                $em->remove($old_network);
            }
        }

        foreach ($data['network'] as $interface => $network_data){

            $network = $this->getDoctrine()->getRepository(Network::class)->findOneBy([
                'interface' => $interface,
                'minion' => $minion
            ]);
            if (!$network){
                $network = new Network();
                $network->setInterface($interface)->setMacAddress($network_data['mac'])->setMinion($minion);
            }
            $network->setMacAddress($network_data['mac']);


            $old_ips = $network->getIps();

            foreach ($old_ips as $old_ip){
                if (!in_array($old_ip->getIpAddress(),$network_data["ips"])){
                    $em->remove($old_ip);
                }
            }

            foreach ($network_data['ips'] as $ip_value){
                $ip = $this->getDoctrine()->getRepository(IPs::class)->findOneBy([
                    'network' => $network,
                    'ip_address' => $ip_value
                ]);
                if (!$ip){
                    $ip = new IPs();
                    $ip->setNetwork($network)->setIpAddress($ip_value);
                }
                $em->persist($ip);

            }

            $em->persist($network);
        }

        $pkg_info = $data['pkg_info'];

        $old_packages = $minion->getInstalledSoftware();
        foreach ($old_packages as $old_package){
            $pkg_name = $old_package->getSoft()->getName();
            if (!array_search($pkg_name,array_column($pkg_info,'name'))){
                $em->remove($old_package);
            }
        }

        foreach ($pkg_info as $package){

            $soft = $this->getDoctrine()->getRepository(Soft::class)->findOneBy([
                'name' => $package['name']
            ]);
            if (!$soft){
                $soft = new Soft();
                $soft->setName($package['name']);
                $em->persist($soft);
            }

            $installed = $this->getDoctrine()->getRepository(InstalledSoftware::class)->findOneBy([
                'minion' => $minion,
                'soft' => $soft
            ]);
            if (!$installed){
                $installed = new InstalledSoftware();
                $installed->setMinion($minion)->setSoft($soft);
            }
            $installed->setSize($package['size'])->setVersion($package['version']);
            $em->persist($installed);

        }

        $old_disks = $minion->getDisks();
        $logger->debug('INFO DISK === ',$data['disk_info']);
        foreach ($old_disks as $old_disk){
            $disk_name = $old_disk->getName();
            $logger->debug(
                'DISK_NAME'.$disk_name
            );
            if (!array_key_exists($disk_name,$data['disk_info'])){
                $em->remove($old_disk);
            }
        }

        foreach ($data['disk_info'] as $disk_name => $disk_info){
            $disk = $this->getDoctrine()->getRepository(Disk::class)->findOneBy([
                'minion' => $minion,
                'name' =>$disk_name
            ]);
            if(!$disk){
                $disk = new Disk();
                $disk->setName($disk_name)->setMinion($minion);
            }
            $disk->setAvailable($disk_info['available'])
                ->setCapacity($disk_info['capacity'])
                ->setBlocks($disk_info['1K-blocks'])
                ->setFilesystem($disk_info['filesystem'])
                ->setUsed($disk_info['used']);

            $em->persist($disk);
        }

        $em->persist($minion);
        $em->flush();

        return $this->json(
            [
                'res' => $uuid,
                'data' => $data
            ]
        );
    }

    /**
     * @Route("/info", name="minion_info", methods={"GET"})
     * @return Response
     */
    public function info(): Response{
        $d = $this->getDoctrine()->getRepository(Minion::class)->count_info();

        return $this->json($d);
    }
}
