<?php

namespace App\Controller;

use App\Entity\StatutReservation;
use App\Form\StatutReservationType;
use App\Repository\StatutReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/statut/reservation')]
#[IsGranted('ROLE_USER', message: "Tu n'as rien à faire là.")]
final class StatutReservationController extends AbstractController
{
    #[Route(name: 'app_statut_reservation_index', methods: ['GET'])]
    public function index(StatutReservationRepository $statutReservationRepository): Response
    {
        return $this->render('statut_reservation/index.html.twig', [
            'statut_reservations' => $statutReservationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statutReservation = new StatutReservation();
        $form = $this->createForm(StatutReservationType::class, $statutReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statutReservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_statut_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_reservation/new.html.twig', [
            'statut_reservation' => $statutReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_reservation_show', methods: ['GET'])]
    public function show(StatutReservation $statutReservation): Response
    {
        return $this->render('statut_reservation/show.html.twig', [
            'statut_reservation' => $statutReservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutReservation $statutReservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatutReservationType::class, $statutReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_statut_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_reservation/edit.html.twig', [
            'statut_reservation' => $statutReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, StatutReservation $statutReservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $statutReservation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($statutReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_statut_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
