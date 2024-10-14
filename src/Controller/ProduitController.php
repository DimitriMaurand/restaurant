<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategorieProduitRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Masterminds\HTML5\Elements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/admin/produit')]
#[IsGranted('ROLE_USER', message: "Tu n'as rien à faire là.")]
final class ProduitController extends AbstractController
{
    #[Route(name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository, CategorieProduitRepository $categorieProduitRepository, Request $request): Response
    {
        // Récupération de toutes les catégories de produits pour générer les boutons
        $categories = $categorieProduitRepository->findAll();

        // Récupération du paramètre de filtre
        $categorieNom = $request->query->get('categorie');

        // Si une catégorie est sélectionnée, on filtre les produits par cette catégorie
        if ($categorieNom) {
            // Trouver la catégorie par nom
            $categorie = $categorieProduitRepository->findOneBy(['nom' => $categorieNom]);

            // Si la catégorie existe, on filtre les produits par cette catégorie
            if ($categorie) {
                $produits = $produitRepository->findBy(['categorie' => $categorie]);
            } else {
                // Si la catégorie n'existe pas, retourner un tableau vide ou toutes les produits
                $produits = [];
            }
        } else {
            // Si aucune catégorie n'est sélectionnée, on récupère tous les produits
            $produits = $produitRepository->findAll();
        }

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $form->getData();
            $allergenesCollection = $produit->getAllergenes();


            foreach ($allergenesCollection as $allergene) {

                echo $allergene->getId();
            }


            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
