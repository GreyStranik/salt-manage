<?php

namespace App\Controller\Api;

use App\Repository\Helpers\SoftRepository;
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

}
