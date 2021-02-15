<?php

namespace App\Controller\Api;

use App\Entity\Helpers\CpuModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CpuModelController
 * @package App\Controller\Api
 * @Route("/api/cpu_model")
 */
class CpuModelController extends AbstractController
{
    /**
     * @Route("/", name="api_cpu_model", methods={"GET"})
     */
    public function index(): Response
    {
        $cpu = $this->getDoctrine()->getRepository(CpuModel::class)->findAll();
        return $this->json($cpu);
    }

    /**
     * @return Response
     * @Route("/cpu_static", name="cpu_static", methods={"GET"})
     */
    public function cpu_static():Response
    {
        $data = $this->getDoctrine()->getRepository(CpuModel::class)->cpu_static();

        return $this->json($data);
    }
}
