<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FontMenuController extends AbstractController
{
    #[Route('/menu', name: 'app_font_menu')]
    public function index(MenuRepository $menuRepository, SerializerInterface $serialize): Response
    {
        // $menu = $menuRepository->findAll();
        // $data = $serialize->serialize($menu, 'json', ['groups' => 'menu']);
        // dd($menuRepository->findOneBy(['id' => 1]));
        return $this->render('font_menu/index.html.twig', [

            'menus' => $menuRepository->findAll(),
        ]);
    }
}
