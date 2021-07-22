<?php

namespace App\Controller;

use App\Repository\SeatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SeatRepository $seatRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'seats' => $seatRepository->findBy(
                [],
                ['id' => 'DESC'],
                3
            )
        ]);
    }
}
