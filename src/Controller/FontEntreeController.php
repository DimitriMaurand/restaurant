<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

class FontEntreeController extends AbstractController
{
    #[Route('/entree', name: 'app_font_entree')]
    public function index(ProduitRepository $produitRepository, SerializerInterface $serizlize): Response
    {
        $prod = $produitRepository->findAll();
        // dd($prod);

        $data = $serizlize->serialize($prod, 'json', ['groups' => 'prod']);
        return $this->render('font_entree/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
