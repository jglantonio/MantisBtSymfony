<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Project;
use App\Enum\CategoryStatus;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category')]
final class CategoryController extends AbstractController
{
    #[Route(name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager ): Response
    {
        return $this->render('category/new.html.twig', [
            'projects' => $this->getUser()->getProjects(),
        ]);
    }
    #[Route('/store', name: 'app_category_store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager,ProjectRepository $projectRepository): Response
    {
        $category = new Category();
        $category->setName($request->request->get('name'));
        $category->setUser($this->getUser());
        $category->setStatus($request->request->get('status')??0);
        $category->setProject($projectRepository->find($request->getPayload()->get('project_id')));
        $entityManager->persist($category);
        $entityManager->flush();
        return $this->redirect('/', Response::HTTP_FOUND);
    }

    #[Route('/{id}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'projects' => $this->getUser()->getProjects(),
        ]);
    }

    #[Route('/{id}/update', name: 'app_category_update', methods: ['POST'])]
    public function update(Request $request, Category $category, EntityManagerInterface $entityManager,ProjectRepository $projectRepository): Response
    {
        $result = true;

        $category->setName($request->getPayload()->get('name'));
        $category->setStatus($request->getPayload()->get('status')?1:0);
        $category->setProject($projectRepository->find($request->getPayload()->get('project_id')));
        $entityManager->flush();
        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'projects' => $this->getUser()->getProjects(),
            'meesage' => $result,
        ]);
    }

    #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
