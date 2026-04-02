<?php

namespace App\Controller;

use App\Repository\BugEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainMenuController extends AbstractController
{
    #[Route('/main/menu', name: 'app_main_menu')]
    public function index(BugEntityRepository $bugEntityRepository,Security $security): Response
    {
        $user = $security->getUser();
        $inciencias = $bugEntityRepository->getIncidenciasByHandlerId($user->getId());
        dd($inciencias);
        return $this->render('main_menu/index.html.twig', [
            'controller_name' => 'MainMenuController',
            'incidencias' => $inciencias
        ]);
    }
}
