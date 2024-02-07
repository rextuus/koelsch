<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Service\Image\ImageService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/archive', name: 'app_archive')]
    public function archive(Request $request, PaginatorInterface $paginator, ImageRepository $imageRepository): Response
    {
        $query = $imageRepository->createQueryBuilder('i')->getQuery();

        $images = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // Current page number
            10 // Items per page
        );

        return $this->render('landing/archive.html.twig', [
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
