<?php

namespace App\Controller;

use App\Repository\BugEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BugController extends AbstractController
{
    #[Route('/bug', name: 'app_bug')]
    public function index(): Response
    {
        return $this->render('bug/index.html.twig', [
            'controller_name' => 'BugController',
        ]);
    }
}
