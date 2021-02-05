<?php

namespace App\Controller\Api;

use App\Entity\Minion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MinionController
 * @package App\Controller\Api
 * @Route("/api/minion")
 */
class MinionController extends AbstractController
{
    /**
     * @Route("/", name="api_get_all_minion")
     */
    public function index(): Response
    {
        $minions =$this->getDoctrine()->getRepository(Minion::class)->findAll();

        return $this->json($minions);
    }
}
