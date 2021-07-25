<?php

namespace App\Controller;

use App\Entity\SearchSeat;
use App\Form\SearchSeatType;
use App\Repository\SeatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OfferController extends AbstractController
{
    /**
     * @Route("/offer", name="offer")
     */
    public function index(SeatRepository $seatRepository, Request $request): Response
    {
        $searchSeat = new SearchSeat();
        $form = $this->createForm(SearchSeatType::class, $searchSeat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seats = $seatRepository->findBySearch($searchSeat);
        }

        return $this->render('offer/index.html.twig', [
            'seats' => $seats ?? $seatRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
