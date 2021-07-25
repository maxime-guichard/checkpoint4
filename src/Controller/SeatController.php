<?php

namespace App\Controller;

use App\Entity\Seat;
use App\Form\SeatType;
use App\Repository\SeatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/seat")
 */
class SeatController extends AbstractController
{
    /**
     * @Route("/", name="seat_index", methods={"GET"})
     */
    public function index(SeatRepository $seatRepository): Response
    {
        return $this->render('seat/index.html.twig', [
            'seats' => $seatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seat_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $seat = new Seat();
        $form = $this->createForm(SeatType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seat);
            $entityManager->flush();

            return $this->redirectToRoute('seat_index');
        }

        return $this->render('seat/new.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seat_show", methods={"GET"})
     */
    public function show(Seat $seat): Response
    {
        return $this->render('seat/show.html.twig', [
            'seat' => $seat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seat_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Seat $seat): Response
    {
        $form = $this->createForm(SeatType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seat_index');
        }

        return $this->render('seat/edit.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seat_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Seat $seat): Response
    {
        if ($this->isCsrfTokenValid('delete' . $seat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seat_index');
    }
}
