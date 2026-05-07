<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\CategoryRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhotoController extends AbstractController
{
    #[Route('/', name: 'app_photo')]
    public function index(PhotoRepository $photoRepository ,CategoryRepository $catego): Response
    {
        $photos = $photoRepository->findAll();  
        return $this->render('photo/index.html.twig', [
            'photos' => $photos,
            'categories'=>$catego->findAll()
        ]);
    }

    #[Route('photo/{id}',name:'app_show', methods:['GET'])]
    public function show(Photo $photo)
    {
        return $this->render ('photo/show.html.twig',[
            'photo'=>$photo,
        ]);
    }

}
