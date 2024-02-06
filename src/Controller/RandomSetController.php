<?php

namespace App\Controller;

use App\Service\RandomService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomSetController extends AbstractController
{
    #[Route('/gambling', name: 'app_random_set')]
    public function index(RandomService $randomService): Response
    {
        $randomSet = $randomService->getRandomSet();
        return $this->render('random_set/index.html.twig', [
            'randomSet' => $randomSet,
        ]);
    }
}
