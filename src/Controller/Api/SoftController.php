<?php

namespace App\Controller\Api;

use App\Repository\Helpers\SoftRepository;
use App\Repository\InstalledSoftwareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SoftController
 * @package App\Controller\Api
 * @Route("/api/soft")
 */

class SoftController extends AbstractController
{
    /**
     * @Route("/", name="api_soft", methods={"GET"})
     */
    public function index(SoftRepository $softRepository): Response
    {
        $softs = $softRepository->findAll();
        $data = [];
        foreach ($softs as $soft){
            $data[] = [
                'id' => $soft->getId(),
                'name' => $soft->getName()
            ];
        }
        return $this->json($data);
    }

    /**
     * @param SoftRepository $softRepository
     * @return JsonResponse
     * @Route("/soft_static", name="soft_static", methods={"GET"} )
     */
    public function soft_static(SoftRepository $softRepository): JsonResponse
    {
        $data = $softRepository->soft_static();
        return $this->json($data);
    }

    /**
     * @Route("/{id}", name="soft_installed_info", methods={"GET"})
     * @param string $id
     * @param SoftRepository $softRepository
     * @param InstalledSoftwareRepository $installedSoftwareRepository
     * @return JsonResponse
     */
    public function soft_info(string $id,SoftRepository $softRepository, InstalledSoftwareRepository $installedSoftwareRepository):JsonResponse
    {
        $soft = $softRepository->find($id);
        $soft_name = $soft->getName();
        $soft_install_list = $installedSoftwareRepository->findBy([
            'soft' => $soft
        ]);
        $installed = [];
        foreach ($soft_install_list as $soft_install){
            $installed[] =[
                'id' => $soft_install->getMinion()->getId(),
                'node_name' => $soft_install->getMinion()->getNodeName(),
                'size' =>$soft_install->getSize(),
                'version' => $soft_install->getVersion(),
                'installed_at' => $soft_install->getInstalledAt()
            ];
        }

        return $this->json([
            'name' => $soft_name,
            'installed' => $installed
        ]);

    }

}
