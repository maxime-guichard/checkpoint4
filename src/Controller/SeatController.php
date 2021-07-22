<?php

namespace App\Controller;

use App\Repository\SeatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeatController extends AbstractController
{
    /**
     * @Route("/sièges", name="seat")
     */
    public function index(SeatRepository $seatRepository): Response
    {
        $seats = $seatRepository->findall();

        return $this->render('seat/index.html.twig', [
            'seats' => $seats,
        ]);
    }
}
