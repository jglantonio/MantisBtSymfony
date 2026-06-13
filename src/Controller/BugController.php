<?php

namespace App\Controller;

use App\Enum\BugPriority;
use App\Enum\BugStatus;
use App\Repository\BugRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
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
    public function create(
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        Security $security
    ): Response {
        $user = $security->getUser();

        return $this->render('bug/create.html.twig', [
            'controller_name' => 'BugController',
            'projects' => $this->getUser()->getProjects(),
            'users' => $userRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'priorities' => BugPriority::cases(),
            'statuses' => BugStatus::cases(),
        ]);
    }
}
