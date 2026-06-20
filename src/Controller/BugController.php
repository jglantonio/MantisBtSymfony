<?php

namespace App\Controller;

use App\Entity\Bug;
use App\Enum\BugPriority;
use App\Enum\BugStatus;
use App\Repository\BugRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BugController extends AbstractController
{
    #[Route('/bug', name: 'app_bug')]
    public function index(BugRepository $BugRepository,Security $security): Response
    {
        $user = $security->getUser();
        $inciencias = array_merge(
            $BugRepository->getIncidenciasByReporterId($user->getId()),
            $BugRepository->getIncidenciasByHandlerId($user->getId())
        );
        return $this->render('bug/index.html.twig', [
            'controller_name' => 'BugController',
            'incidencias' => $inciencias
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

    #[Route('/bug/store', name: 'app_bug_store', methods: ['POST'])]
    public function store(
        Request $request,
        EntityManagerInterface $entityManager,
        ProjectRepository $projectRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $payload = $request->getPayload();
        $bug = new Bug();
        $bug->setProject($projectRepository->findById($payload->get('project_id')));
        $bug->setStatus($payload->get('status'));
        $bug->setPriority($payload->get('priority'));
        $bug->setCategory($categoryRepository->findById($payload->get('category_id')));
        $bug->setHandler($userRepository->findById($payload->get('handler_id')));
        $bug->setSummary($payload->get('summary'));
        $bug->setReporter($this->getUser());
        $bug->setDateSubmitted(time());
        $bug->setLastUpdated(time());
        $bug->setBugTextId(0);
        $entityManager->persist($bug);
        $entityManager->flush();
        return $this->redirectToRoute('app_main_menu');
    }

    #[Route('/bug/show/{id}', name: 'app_bug_show', methods: ['GET'])]
    public function show(Bug $bug, UserRepository  $userRepository , CategoryRepository $categoryRepository): Response
    {

        return $this->render('bug/show.html.twig', [
            'bug' => $bug,
            'notes' =>[],
            'tags' =>[],
            'controller_name' => 'BugController',
            'projects' => $this->getUser()->getProjects(),
            'users' => $userRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'priorities' => BugPriority::cases(),
            'statuses' => BugStatus::cases(),
        ]);
    }
}
