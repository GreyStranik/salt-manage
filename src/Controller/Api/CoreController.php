<?php

namespace App\Controller\Api;

use App\Repository\Helpers\SoftRepository;
use App\Repository\MinionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CoreController
 * @package App\Controller\Api
 * @Route("/api")
 */
class CoreController extends AbstractController
{
//    /**
//     * @Route("/api/core", name="api_core")
//     */
//    public function index(): Response
//    {
//        return $this->json([
//            'message' => 'Welcome to your new controller!',
//            'path' => 'src/Controller/Api/CoreController.php',
//        ]);
//    }

    /**
     * @Route("/search", name="api_search", methods={"GET"})
     * @param Request $request
     * @param MinionRepository $minionRepository
     * @return JsonResponse
     */
    public function search(Request $request,MinionRepository $minionRepository,SoftRepository $softRepository):JsonResponse
    {
        $q = $request->query->get('q','');
        $minion = $minionRepository->simple_find($q);
        $soft = $softRepository->simple_find($q);
        return $this->json([
            'minion' => $minion,
            'soft' => $soft
        ]);
    }
}