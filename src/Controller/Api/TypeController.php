<?php

namespace App\Controller\Api;

use App\Repository\Helpers\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TypeController
 * @package App\Controller\Api
 * @Route("/api/type")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="api_type_list", methods={"GET"})
     */
    public function index(TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();
        return $this->json($types);
    }

    /**
     * @Route("/type_statistic", name="type_statistic", methods={"GET"})
     * @param TypeRepository $typeRepository
     * @return Response
     */
    public function type_statistic(TypeRepository $typeRepository): Response
    {
        $data = $typeRepository->type_statistic();
        return $this->json($data);
    }
}
