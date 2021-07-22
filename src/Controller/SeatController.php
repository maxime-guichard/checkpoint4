<?php

namespace App\Controller;

use App\Entity\SearchSeat;
use App\Repository\SeatRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\SearchSeatType;

class SeatController extends AbstractController
{
    /**
     * @Route("/sièges", name="seat_list")
     */
    public function index(SeatRepository $seatRepository, Request $request): Response
    {
        $searchSeat = new SearchSeat();
        $form = $this->createForm(SearchSeatType::class, $searchSeat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //traitement
            $seats = $seatRepository->findBySearch($searchSeat);
        }

        $seats = $seatRepository->findAll();
        return $this->render('seat/index.html.twig', [
            'seats' => $seats ?? $seatRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sièges/{id}", name="seat_show")
     */
    public function show(int $id, SeatRepository $seatRepository): Response
    {
        $seat = $seatRepository->find($id);
        return $this->render('seat/show.html.twig', [
            'seat' => $seat,
        ]);
    }
}
