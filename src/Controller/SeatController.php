<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeatController extends AbstractController
{
    /**
     * @Route("/sièges", name="seat")
     */
    public function index(): Response
    {
        return $this->render('seat/index.html.twig');
    }
}
