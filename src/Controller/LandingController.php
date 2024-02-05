<?php

namespace App\Controller;

use App\Service\Image\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ImageService $imageService): Response
    {
        $images = $imageService->findAll();
        return $this->render('landing/index.html.twig', [
            'images' => $images,
        ]);
    }

    #[Route('/impressum', name: 'app_impressum')]
    public function test(): Response
    {
        return $this->render('landing/impressum.html.twig', [
        ]);
    }
}
