<?php

namespace App\Controller\Api;

use App\Entity\Helpers\Department;
use App\Repository\Helpers\DepartmentRepository;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class DepartmentController
 * @package App\Controller\Api
 * @Route("/api/department")
 */
class DepartmentController extends AbstractController
{
    /**
     * @Route("/", name="api_department", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(DepartmentRepository $departmentRepository, LoggerInterface $logger)
    {
        $departments = $departmentRepository->findAllOrdered();

        return $this->json($departments);
    }
}
