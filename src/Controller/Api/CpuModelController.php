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
     * @Route("/api/cpu/model", name="api_cpu_model")
     */
    public function index(): Response
    {
        $cpu = $this->getDoctrine()->getRepository(CpuModel::class)->findAll();
        return $this->json($cpu);
    }
}
