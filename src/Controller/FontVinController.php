<?php

namespace App\Controller;

use App\Repository\BoissonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FontVinController extends AbstractController
{
    #[Route('/vin', name: 'app_font_vin')]
    public function index(BoissonRepository $boissonRepository, SerializerInterface $serizlize): Response
    {
        $boisson = $boissonRepository->findAll();

        $data = $serizlize->serialize($boisson, 'json', ['groups' => 'boisson']);
        return $this->render('font_vin/index.html.twig', [
            'boissons' => $boissonRepository->findAll(),
        ]);
    }
}
