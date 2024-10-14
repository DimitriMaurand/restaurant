<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // Remplacé BrowserKit par HttpFoundation
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $Reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $Reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $Reservation->setDateEnvoi(new \DateTime());
            $data = $request->request->all();
            // dd($request->request->all());
            $rgpdChecked = $data['reservation']['rgpd'] ?? null;
            // Vérification si la case RGPD a été cochée et définir la date d'acceptation RGPD

            if ($rgpdChecked == 1) {
                $Reservation->setRgpd(new \DateTime());
                // dd($Reservation, 1);
            } else {
                // dd($Reservation, 0);
                $this->addFlash('error', 'Vous devez accepter les conditions RGPD pour continuer.');
                return $this->redirectToRoute('app_home');
            }

            $entityManager->persist($Reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'statut_reservation' => $Reservation,
            'form' => $form->createView(),
        ]);
    }
}
