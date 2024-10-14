<?php

// src/Controller/ReservationController.php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/reservation')]
#[IsGranted('ROLE_USER', message: "Tu n'as rien à faire là.")]
final class ReservationController extends AbstractController
{
    #[Route(name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();

        $showStatut = $this->shouldShowStatut($request);


        $form = $this->createForm(ReservationType::class, $reservation, ['show_statut' => $showStatut]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'La réservation a été créée avec succès.');

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        // Récupérer la valeur actuelle du champ rgpd
        $currentRgpd = $reservation->getRgpd();

        // Déterminez si le champ doit être visible
        $showStatut = $this->shouldShowStatut($request);

        // Créez le formulaire avec l'option show_statut
        $form = $this->createForm(ReservationType::class, $reservation, ['show_statut' => $showStatut]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Remettre l'ancienne valeur du champ rgpd dans l'entité
            $reservation->setRgpd($currentRgpd);

            // Sauvegarder les modifications dans la base de données
            $entityManager->flush();
            $this->addFlash('success', 'La réservation a été mise à jour avec succès.');
            // Rediriger vers une autre route après la mise à jour
            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        // Afficher le formulaire dans la vue
        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    private function shouldShowStatut(Request $request): bool
    {
        // Exemple de logique : ne pas afficher le champ sur la page d'accueil ou d'autres pages spécifiques
        return $request->attributes->get('_route') !== 'app_reservation_index';
    }
}
