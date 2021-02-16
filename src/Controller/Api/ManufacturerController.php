<?php

namespace App\Controller\Api;

use App\Repository\Helpers\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ManufacturerController
 * @package App\Controller\Api
 * @Route("/api/manufacturer")
 */
class ManufacturerController extends AbstractController
{
    /**
     * @Route("/", name="api_manufacturer", methods={"GET"})
     */
    public function index(ManufacturerRepository $manufacturerRepository): Response
    {
        $data = $manufacturerRepository->findAll();
        $manufacturer = [];
        foreach ($data as $item){
            $manufacturer[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }
        return $this->json($manufacturer);
    }
}
