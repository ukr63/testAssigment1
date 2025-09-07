<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class LeadController extends AbstractController
{
    #[Route('/lead', name: 'app_lead')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LeadController.php',
        ]);
    }

    #[Route('/api/test', name: 'app_lead')]
    public function api_test(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LeadController.php',
        ]);
    }
}
