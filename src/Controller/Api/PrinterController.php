<?php

namespace App\Controller\Api;

use App\Repository\Equipment\PrinterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PrinterController
 * @package App\Controller\Api
 * @Route("/api/printer")
 */
class PrinterController extends AbstractController
{
    /**
     * @Route("/", name="api_printer", methods={"GET"})
     */
    public function index(PrinterRepository $printerRepository): Response
    {
        $data = $printerRepository->printer_list();
        return $this->json($data);
    }
}
