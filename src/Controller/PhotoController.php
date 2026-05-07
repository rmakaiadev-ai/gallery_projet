<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\CategoryRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhotoController extends AbstractController
{
    #[Route('/', name: 'app_photo')]
    public function index(Request $request, PhotoRepository $photoRepository, CategoryRepository $catego): Response
    {
        $categoryId = $request->query->get('category');

        if ($categoryId) {
            $photos = $photoRepository->findBy(['category' => $categoryId]);
        } else {
            $photos = $photoRepository->findAll();
        }

        return $this->render('photo/index.html.twig', [
            'photos' => $photos,
            'categories' => $catego->findAll(),
            'currentCategory' => $categoryId,
        ]);
    }

    #[Route('photo/{id}', name: 'app_show', methods: ['GET'])]
    public function show(Photo $photo): Response
    {
        return $this->render('photo/show.html.twig', [
            'photo' => $photo,
        ]);
    }
}