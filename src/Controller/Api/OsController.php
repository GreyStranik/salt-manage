<?php

namespace App\Controller\Api;

use App\Repository\Helpers\OsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OsController
 * @package App\Controller\Api
 * @Route("/api/os")
 */
class OsController extends AbstractController
{
    /**
     * @Route("/", name="api_os_list", methods={"GET"})
     */
    public function index(OsRepository $osRepository): Response
    {
        $data = $osRepository->findAll();
        $oss = [];
        foreach ($data as $item){
            $oss[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }
        return $this->json($oss);
    }

    /**
     * @Route("/os_static", name="os_static", methods={"GET"})
     * @param OsRepository $osRepository
     * @return Response
     */
    public function os_static(OsRepository $osRepository): Response
    {
        $data = $osRepository->os_static();
        return $this->json($data);
    }

}
