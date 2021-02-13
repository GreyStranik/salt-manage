<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="core", requirements={"reactRouting"="^(?!api).+"}, defaults={"reactRouting": null})
     */
    public function index(): Response
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }
}
