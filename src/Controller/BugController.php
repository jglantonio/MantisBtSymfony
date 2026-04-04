<?php

namespace App\Controller;

use App\Repository\BugRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
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

    #[Route('/bug/create', name: 'app_bug_create')]
    public function create(ProjectRepository $projectRepository, Security $security): Response
    {
        $user = $security->getUser();
        return $this->render('bug/create.html.twig', [
            'controller_name' => 'BugController',
            'projects' => $projectRepository->findByUser($user->getId()),
        ]);
    }
}
