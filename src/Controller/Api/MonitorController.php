<?php

namespace App\Controller\Api;

use App\Repository\Equipment\MonitorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MonitorController
 * @package App\Controller\Api
 * @Route("/api/monitor")
 */
class MonitorController extends AbstractController
{
    /**
     * @Route("/", name="api_monitor", methods={"GET"})
     */
    public function index(MonitorRepository $monitorRepository): Response
    {
        $data = $monitorRepository->monitor_list();
        return $this->json($data);
    }
}
