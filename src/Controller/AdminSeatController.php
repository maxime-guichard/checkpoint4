<?php

namespace App\Controller;

use App\Entity\Seat;
use App\Form\SeatType;
use App\Repository\SeatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/category")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminSeatController extends AbstractController
{
    /**
     * @Route("/", name="admin_seat_index", methods={"GET"})
     */
    public function index(SeatRepository $seatRepository): Response
    {
        return $this->render('admin_seat/index.html.twig', [
            'seats' => $seatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_seat_new", methods={"GET","POST"})
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
            $this->addFlash('success', 'La siège a bien été crée');

            return $this->redirectToRoute('admin_seat_index');
        }

        return $this->render('admin_category/new.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_seat_show", methods={"GET"})
     */
    public function show(Seat $seat): Response
    {
        return $this->render('admin_seat/show.html.twig', [
            'seat' => $seat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_seat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seat $seat): Response
    {
        $form = $this->createForm(SeatType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le siège a bien été modifiée');

            return $this->redirectToRoute('admin_seat_index');
        }

        return $this->render('admin_seat/edit.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_seat_delete", methods={"POST"})
     */
    public function delete(Request $request, Seat $seat): Response
    {
        if ($this->isCsrfTokenValid('delete' . $seat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seat);
            $entityManager->flush();
            $this->addFlash('success', 'La siège a bien été supprimée');
        }

        return $this->redirectToRoute('admin_seat_index');
    }
}
