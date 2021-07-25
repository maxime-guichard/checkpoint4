<?php

namespace App\Controller;

use App\Repository\SeatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    /**
     * @Route("/offer", name="offer")
     */
    public function index(SeatRepository $seatRepository): Response
    {
        return $this->render('offer/index.html.twig', [
            'seats' => $seatRepository->findAll(),
        ]);
    }
}
