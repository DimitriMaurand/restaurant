<?php

namespace App\Controller;

use App\Entity\CategorieBoisson;
use App\Form\CategorieBoissonType;
use App\Repository\CategorieBoissonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/categorie/boisson')]
#[IsGranted('ROLE_USER', message: "Tu n'as rien à faire là.")]
final class CategorieBoissonController extends AbstractController
{
    #[Route(name: 'app_categorie_boisson_index', methods: ['GET'])]
    public function index(CategorieBoissonRepository $categorieBoissonRepository): Response
    {
        return $this->render('categorie_boisson/index.html.twig', [
            'categorie_boissons' => $categorieBoissonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_boisson_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieBoisson = new CategorieBoisson();
        $form = $this->createForm(CategorieBoissonType::class, $categorieBoisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieBoisson);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_boisson_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_boisson/new.html.twig', [
            'categorie_boisson' => $categorieBoisson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_boisson_show', methods: ['GET'])]
    public function show(CategorieBoisson $categorieBoisson): Response
    {
        return $this->render('categorie_boisson/show.html.twig', [
            'categorie_boisson' => $categorieBoisson,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_boisson_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieBoisson $categorieBoisson, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieBoissonType::class, $categorieBoisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_boisson_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_boisson/edit.html.twig', [
            'categorie_boisson' => $categorieBoisson,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_boisson_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieBoisson $categorieBoisson, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorieBoisson->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categorieBoisson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_boisson_index', [], Response::HTTP_SEE_OTHER);
    }
}
