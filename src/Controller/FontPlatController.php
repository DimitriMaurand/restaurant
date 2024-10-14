<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FontPlatController extends AbstractController
{
    #[Route('/plat', name: 'app_font_plat')]

    public function index(ProduitRepository $produitRepository, SerializerInterface $serizlize): Response
    {
        $prod = $produitRepository->findAll();
        // dd($prod);

        $data = $serizlize->serialize($prod, 'json', ['groups' => 'prod']);
        return $this->render('font_plat/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
